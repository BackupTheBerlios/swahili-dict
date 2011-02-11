<?php

class WortschatzController extends Controller
{
	const PAGE_SIZE=50;
	
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
		    'search'=>'application.controllers.SearchAction',
		);
	}

	/**
	 * @var string specifies the default action.
	 */
	public $defaultAction='search';

	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // all users
				'actions'=>array('search','detailedSearch','list','view', 'viewDetails', 'download','autocomplete'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

        public function actionDetailedSearch()
	{
            //renders the view 'detailedSearch' and passes the model
            $this->pageDescriptionMetaTag = 'Detailierte Wörtersuche nach Nominalklassen, Wortarten, Themen etc.';

            $model=new wortschatz('search');

                //db columns with default value are set to NULL:
                $model->setAttributes(array('grundwortschatz'=>NULL,
                    'noun_animate'=>NULL,
                    'verb_monosyllabic'=>NULL));

                //andere Möglichkeit dafür wäre:
//                $model->grundwortschatz = NULL;
//                $model->noun_animate = NULL;
//                $model->verb_monosyllabic = NULL;


		if(isset($_GET['wortschatz']))
			$model->attributes=$_GET['wortschatz'];
                
            $this->render('detailedSearch',array(
			'model'=>$model,
		));
	}


        /**
	 * Shows details of a model (e.g. for a found result)
	 */
	public function actionViewDetails()
	{
            //renders the view 'viewDetails' and passes the model with the given id (see: loadwortschatz)
            $this->render('viewDetails',array('model'=>$this->loadwortschatz()));
	}
        
        /**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the primary key value. Defaults to null, meaning using the 'id' GET variable
	 */
	public function loadwortschatz($id=null)
	{
		if($this->_model===null)
		{
			if($id!==null || isset($_GET['id']))
				$this->_model=wortschatz::model()->findbyPk($id!==null ? $id : $_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}

        public function actionAutocomplete() {
	$result =array();

	if (isset($_GET['term'])) {
		// http://www.yiiframework.com/doc/guide/database.dao
                $kiswahili = wortschatz::model()->trimSQL('kiswahili');
		$qtxt1 ="SELECT kiswahili FROM wortschatz WHERE ( ".$kiswahili." LIKE :term ) GROUP BY 1 ORDER BY 1";
		$command1 =Yii::app()->db->createCommand($qtxt1);
		$command1->bindValue(":term", $_GET['term'].'%', PDO::PARAM_STR);
		$result1 =$command1->queryColumn(); //queryColumn() gibt nur die erste Spalte des Ergebnisses zurueck

                $qtxt2 ="SELECT noun_plural_swahili FROM wortschatz WHERE ( noun_plural_swahili LIKE :term ) GROUP BY 1 ORDER BY 1";
		$command2 =Yii::app()->db->createCommand($qtxt2);
		$command2->bindValue(":term", $_GET['term'].'%', PDO::PARAM_STR);
		$result2 =$command2->queryColumn(); //queryColumn() gibt nur die erste Spalte des Ergebnisses zurueck

                $qtxt3 ="SELECT deutsch FROM wortschatz WHERE ( deutsch LIKE :term ) GROUP BY 1 ORDER BY 1";
		$command3 =Yii::app()->db->createCommand($qtxt3);
		$command3->bindValue(":term", $_GET['term'].'%', PDO::PARAM_STR);
		$result3 =$command3->queryColumn(); //queryColumn() gibt nur die erste Spalte des Ergebnisses zurueck

                $resultA = CMap::mergeArray($result1,$result2);
                $result = CMap::mergeArray($resultA,$result3);
                sort($result);
	}

	echo CJSON::encode($result);
	Yii::app()->end();
}
}
