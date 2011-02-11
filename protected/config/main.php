<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
        'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
        'name'=>'Wörterbuch kiswahili-deutsch',
        'charset'=>'UTF-8',
        'language'=>'de',

        // preloading 'log' component
        'preload'=>array('log'),

        // autoloading model and component classes
        'import' => array(
                'application.models.*',
                'application.components.*',
                'application.modules.user.models.*', //yii-user extension
                'application.modules.user.components.*', //yii-user extension
                'application.modules.rights.*', //rights extension
                'application.modules.rights.components.*', //rights extension
        ),
        'modules'=>array(
            'user', //extension yii-user (http://www.yiiframework.com/extension/yii-user/)
            'rights'=>array(
                'install'=>false, // Enables the installer of the rights extension
            ),
        ),

        // application components
        'components'=>array(
                'log'=>array(
                        'class'=>'CLogRouter',
                        'routes'=>array(
                                array(
                                        'class'=>'CFileLogRoute',
                                        'levels'=>'error, warning',
                                ),
                        ),
                ),
                'user'=>array(
                        // enable cookie-based authentication
                        'allowAutoLogin'=>true,
                        'loginUrl' => array('/user/login'),
                        'class'=>'RightsWebUser', // Allows super users access implicitly (rights extension)
                ),
                'authManager'=>array(
                    'class'=>'RightsAuthManager', // Provides support authorization item sorting (rights extension)
                ),
                'urlManager'=>array(
                        'urlFormat'=>'path',
                ),

                'db'=>array(
                        'class'=>'CDbConnection',
                        'connectionString'=>'yourConnectionStringHere',
                        'username'=>'yourDB-user',
                        'password'=>'yourDB-password',
                        'charset'=>'utf8',
                        'tablePrefix'=>'tbl_',
                ),
                'errorHandler'=>array(
                        'errorAction'=>'site/error', //refers to the error action in SiteController
                ),
                'file'=>array(
                        'class'=>'application.extensions.file.CFile',
                ),
                'timer'=>array(
                        'class'=>'Timer',
                ),

        ),

        // register controllers
        'controllerMap'=>array(
                'csv'=>array(
                        'class'=>'application.extensions.csv.CsvController',
                //'table'=>'.resultTable',
                ),
        ),

        // application-level parameters that can be accessed
        // using Yii::app()->params['paramName']
        'params'=>array(
        // this is used in contact page
                'adminEmail'=>'admin@adress.com',
                'version'=>'currentVersion',
        ),
);