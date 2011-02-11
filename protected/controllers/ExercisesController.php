<?php

class ExercisesController extends Controller
{
        /**
	 * @var string the default layout for the views. Defaults to 'column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='main';


	/**
	 * @var string specifies the default action.
	 */
	public $defaultAction='index';


        public function actionIndex()
	{
		$this->render('index');
	}

        public function actionDeklinationen()
	{
		$model=deklinationen::model();

                $this->render('deklinationen',array(
                'model'=>$model,
        ));
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}