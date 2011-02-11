<?php
/**
 * This class (Controller) is the customized base controller class (= the parent controller).
 * All controller classes for this application should extend from this base class.
 * 
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. 
	 */
	public $layout='application.views.layouts._1col';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

        /**
	 * @var array the portlets in the left column of a 2 column page.
	 * Taken from this cookbook: http://www.yiiframework.com/doc/cookbook/28/
	 */
	public $portlets=array();
        
        /**
	 * @var string the content of the Meta Tag 'description'.
	 * According to this tutorial: http://www.yiiframework.com/wiki/54/simplified-meta-tags
	 */
	public $pageDescriptionMetaTag;


}