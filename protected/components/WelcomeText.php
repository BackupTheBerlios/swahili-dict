<?php

/**
 * SearchOptions provides some advanced search options ;-)
 */
Yii::import('zii.widgets.CPortlet');

class WelcomeText extends CPortlet
{   
    public function init()
    {
        parent::init();
    }

    protected function renderContent()
    {
        $this->render('welcomeText');
    }
}