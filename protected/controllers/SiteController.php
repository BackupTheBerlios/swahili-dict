<?php

class SiteController extends Controller
{	
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image
			// this is used by the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xEBF4FB,
			),
                        // shows pages in the /site/pages directory
                        'page'=>array(
                            'class'=>'CViewAction',
                        )
		);
	}

	/**
	 * @var string specifies the default action.
	 */
	public $defaultAction='index';
	
	public function actionIndex() {
            $this->redirect(array('wortschatz/search'));
        }

        /**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

        /**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
                                $model->subject = "Mail von swahili.ndanda-projekt.info: " . $model->subject;
				mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Danke, Ihre Nachricht wurde verschickt.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

        /**
	 * @var string specifies the default action.
	 */
	
	public function actionGrammar()
	{
		$this->render('grammar');
	}

        public function actionClasses()
	{
		$this->render('classes');
	}

        public function actionVerbs()
	{
		$this->render('verbs');
	}

	public function actionAbout()
	{
		$this->render('about');
	}

}