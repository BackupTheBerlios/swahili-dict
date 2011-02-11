<?php

class BackendController extends Controller
{
	const PAGE_SIZE=25;
	

	/**
	 * @var string specifies the default action.
	 */
	public $defaultAction='admin';

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
			array('allow',  // everybody
				'actions'=>array('search','view','create','copy'),
				'users'=>array('*'), // all users
			),
                        array('allow', // authenticated
				'actions'=>array('exportLists'),
				'users'=>array('@'), // all authenticated users
			),
			array('allow', // editors
				'actions'=>array('update','delete'),
                                'roles'=>array('Editor'), // all editors
			),
			array('allow', // admins
				'actions'=>array('admin','AdminDetailedSearch'),
				'users'=>array('admin'), // all admin users
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

        protected function performAjaxValidation($model) {
            if (isset($_POST['ajax']) && $_POST['ajax'] === 'wortschatz-form') {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
        }

	/**
	 * Shows a particular model (e.g. after creating or updating it)
	 */
	public function actionView()
	{
            //renders the view 'show' and passes the model with the given id (see: loadwortschatz)
            $this->render('show',array('model'=>$this->loadwortschatz()));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'show' page.
	 */
	public function actionCreate() {
            $model=new wortschatz('create'); //creates a wortschatz model in the 'create' scenario. Same as: $model=new wortschatz(); $model->scenario='create';
            $this->performAjaxValidation($model); //see function above

            if(isset($_POST['wortschatz'])) {

                $model->attributes=$_POST['wortschatz'];

                if($model->save())
                    $this->redirect(array('view','id'=>$model->id)); //executes the action view
            }
            $this->render('create',array('model'=>$model));
        }

        
        /**
	 * Copies a particular model.
	 * If copy is successful, the browser will be redirected to the 'show' page.
	 */
	public function actionCopy() {
            $model=new wortschatz(); 
            $this->performAjaxValidation($model);

            $model=$this->loadwortschatz();
            $model->isNewRecord=true;
            $model->id=NULL;
            $model->scenario='copy'; //scenario must be set here and not with the instantiation of the model

            if(isset($_POST['wortschatz'])) {

                $model->attributes=$_POST['wortschatz'];

                if($model->save())
                    $this->redirect(array('view','id'=>$model->id)); 
            }
            $this->render('create',array('model'=>$model,'copy'=>true));
        }

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'show' page.
	 */
	public function actionUpdate()
	{
            $model=new wortschatz('update');  //creates a wortschatz model in the 'update' scenario. Same as: $model=new wortschatz(); $model->scenario='update';
            $model=$this->loadwortschatz();
		if(isset($_POST['wortschatz']))
		{
			$model->attributes=$_POST['wortschatz'];
			
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}
		$this->render('update',array('model'=>$model));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'list' page.
	 */
	public function actionDelete() {
//            if(Yii::app()->user->checkAccess('backend.delete')) {
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadwortschatz()->delete();
			$this->redirect(array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
//            }
        }

        /**
	 * Displays the Export lists page.
	 */
        public function actionExportLists() {
//            uses the extension http://www.yiiframework.com/extension/cfile/ located in /protected/extensions/file
//            if(Yii::app()->user->checkAccess('backend.exportLists')) {

                    $criteria=new CDbCriteria;

                    $models=wortschatz::model()->with('wortart_rel', 'kategorie_rel')->findAll($criteria);
                    $content = (CHtml::encode($models[0]->getAttributeLabel('kiswahili')) .';'
                            . CHtml::encode($models[0]->getAttributeLabel('deutsch')) .';'
                            . CHtml::encode($models[0]->getAttributeLabel('deutsch_addition')) .';'
                            . CHtml::encode($models[0]->getAttributeLabel('wortart_id')) .';'
                            . CHtml::encode($models[0]->getAttributeLabel('noun_class')) .';'
                            . CHtml::encode($models[0]->getAttributeLabel('noun_animate')) .';'
                            . CHtml::encode($models[0]->getAttributeLabel('noun_singular_swahili')) .';'
                            . CHtml::encode($models[0]->getAttributeLabel('noun_class_singular')) .';'
                            . CHtml::encode($models[0]->getAttributeLabel('noun_plural_swahili')) .';'
                            . CHtml::encode($models[0]->getAttributeLabel('noun_class_plural')) .';'
                            . CHtml::encode($models[0]->getAttributeLabel('noun_plural_deutsch')) .';'
                            . CHtml::encode($models[0]->getAttributeLabel('verb_monosyllabic')) .';'
                            . CHtml::encode($models[0]->getAttributeLabel('verb_stem')) .';'
                            . CHtml::encode($models[0]->getAttributeLabel('verb_infinitive')) .';'
                            . CHtml::encode($models[0]->getAttributeLabel('kategorie_id')) .';'
                            . CHtml::encode($models[0]->getAttributeLabel('anmerkung')) . "\n");
                    foreach($models as $n=>$model):
                        $content .=  (CHtml::encode($model->kiswahili) .';'
                            . CHtml::encode($model->deutsch) .';'
                            . CHtml::encode($model->deutsch_addition) .';'
                            . CHtml::encode($model->wortart_rel->bezeichnung) .';'
                            . CHtml::encode($model->noun_class) .';'
                            . CHtml::encode($model->noun_animate) .';'
                            . CHtml::encode($model->noun_singular_swahili) .';'
                            . CHtml::encode($model->noun_class_singular) .';'
                            . CHtml::encode($model->noun_plural_swahili) .';'
                            . CHtml::encode($model->noun_class_plural) .';'
                            . CHtml::encode($model->noun_plural_deutsch) .';'
                            . CHtml::encode($model->verb_monosyllabic) .';'
                            . CHtml::encode($model->verb_stem) .';'
                            . CHtml::encode($model->verb_infinitive) .';'
                            . CHtml::encode($model->kategorie_rel->bezeichnung) .';'
                            . CHtml::encode($model->anmerkung) ."\n");
                    endforeach;
        //            $content='test';

                    $file = Yii::app()->file->set('downloads/wortschatz-komplett.csv', true);
                    $file->purge();
        //            if ($file->exists == false) $file->create();
        //            $file->owner='ndandap';
        //            $file->group='ndandap';
        //            $file->permissions=666;
                    $file->setContents($content,true);
        //            $file->delete();
        //            $file->send('wortschatz.csv');

                    $this->render('exportLists',array(
                            'file'=>$file,
                    ));
//            }
        }

	/**
	 * Manages all models.
	 */
	public function actionAdmin() {
//            if(Yii::app()->user->checkAccess('backend.admin')) {

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

		$this->render('admin',array(
			'model'=>$model,
		));
//            }
	}

        /**
	 * Manages all models.
	 */
	public function actionAdminDetailedSearch() {

		$model=new wortschatz('search');

                //db columns with default value are set to NULL:
                $model->setAttributes(array('grundwortschatz'=>NULL,
                    'noun_animate'=>NULL,
                    'verb_monosyllabic'=>NULL));


		if(isset($_GET['wortschatz']))
			$model->attributes=$_GET['wortschatz'];

		$this->render('adminDetailedSearch',array(
                'model'=>$model,
                ));
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

	/**
	 * Executes any command triggered on the admin page.
	 */
	protected function processAdminCommand()
	{
		if(isset($_POST['command'], $_POST['id']) && $_POST['command']==='delete')
		{
			$this->loadwortschatz($_POST['id'])->delete();
			// reload the current page to avoid duplicated delete actions
			$this->refresh();
		}
	}
}
