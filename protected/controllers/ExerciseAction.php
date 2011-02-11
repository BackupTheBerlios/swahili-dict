<?php

class ExerciseAction extends CAction
{
    const PAGE_SIZE=15;
    
    public function run()
    {
	$search=new SearchForm;
	$controller = $this->getController();
	$controller->layout='form';
	
	
			
			$model=adjektive::model();
			
			$criteria=new CDbCriteria;
			//$criteria->select='kiswahili';  // SELECT Clause
			$condition = '';
			$criteria->condition=$condition;
			
			$models=adjektive::model()->findAll($criteria);
			
				$controller->render('search',array(
				'models'=>$models,
			));
    }
}