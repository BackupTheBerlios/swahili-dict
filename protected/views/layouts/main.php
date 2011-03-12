<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="language" content="en" />
    <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/reset.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/nav.css" />
    <meta name="viewport" content="width=320" />
    
    <?php 
        if (!empty($this->pageDescriptionMetaTag)) {
            Yii::app()->clientScript->registerMetaTag($this->pageDescriptionMetaTag, 'description');
        } else {
            Yii::app()->clientScript->registerMetaTag('Online-Wörterbuch zum Mitmachen. Kiswahili-Deutsch-Übersetzungen suchen, verbessern, hinzufügen. Mit Grammatik-Wiki zum Nachschlagen und Verfassen von Grammatik-Artikeln.', 'description');
        }
    ?>
    
    <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/dropdown.js'); ?>
    <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/tooltip.js'); ?>
    <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/tooltip.dynamic.js'); ?>

    <link rel="search" type="application/opensearchdescription+xml" title="Kiswahili-Deutsch-Wörterbuch" href="<?php echo Yii::app()->request->baseUrl; ?>/downloads/kiswahili-deutsch-search.xml" />

    <title><?php echo $this->pageTitle; ?></title>

    <script type="text/javascript">
        function installSearchEngine() {
            if (window.external && ("AddSearchProvider" in window.external)) {
                // Firefox 2 and IE 7, OpenSearch
                window.external.AddSearchProvider("http://swahili.ndanda-projekt.info/downloads/kiswahili-deutsch-search.xml");
            } else {
                // No search engine support (IE 6, Opera, etc).
                alert("Der Browser unterstützt diese Suchmaschine nicht. Sie benötigen Firefox ab Version 3 oder Internet Explorer ab Version 7");
            }
        }
    </script>
    <?php if ($this->id == "someOtherController"): ?>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/backend.css" />
    <?php endif; ?>
</head>
<body>
    <div id="fixed">
    <div id="header">
        <div id="head_title">
            <?php if ($this->id == "someOtherController"): ?>
                <?php echo CHtml::link('<img src="'.Yii::app()->request->baseUrl.'/images/logo_darkseagreen.png" alt="W&ouml;rterbuch Kiswahili-Deutsch" />', array('/wortschatz/search')); ?>
            <?php else: ?>
                <?php echo CHtml::link('<img src="'.Yii::app()->request->baseUrl.'/images/logo_chocolate-hell.png" alt="W&ouml;rterbuch Kiswahili-Deutsch" />', array('/wortschatz/search')); ?>
            <?php endif; ?>
        </div>
        <div id="head_menu">
            <?php
            $this->widget('zii.widgets.CMenu', array(
                'id' => 'nav',
                'itemTemplate' => '{menu}',
                'activateParents' => true,
                'items' => array(
                    array('label' => 'Wörterbuch durchsuchen', 'url' => array('/wortschatz/search')),
                    array('label' => 'Grammatik', 'url' => array('/site/page', 'view' => 'grammar'), 'items' => array(
                            array('label' => 'Übersicht Nominalklassen', 'url' => array('/site/page', 'view' => 'classes')),
                            array('label' => 'Übersicht Verbformen', 'url' => array('/site/page', 'view' => 'verbs')),
                        )),
                    array('label' => 'Mitmachen', 'items' => array(
                            array('label' => 'Begriff hinzufügen', 'url' => array('/backend/create')),
                            array('label' => 'Mitteilung senden', 'url' => array('/site/contact')),
                            array('label' => '------------------------', 'visible' => !Yii::app()->user->isGuest),
                            array('label' => 'Begriffe ändern, löschen, anzeigen', 'url' => array('/backend/admin'), 'visible' => Yii::app()->user->checkAccess('admin')),
                            array('label' => 'Spezialsuche', 'url' => array('/backend/adminDetailedSearch'), 'visible' => Yii::app()->user->checkAccess('admin')),
                            array('label' => 'Wortschatz exportieren', 'url' => array('/backend/exportLists'), 'visible' => !Yii::app()->user->isGuest),
                        )),
                    array('url'=>'/wiki/', 'label'=>'Wiki', 'linkOptions'=>array('target'=>'_blank')),
                    array('label' => 'Hilfe', 'items' => array(
                        array('label' => 'Suchhilfe', 'url' => array('/site/page', 'view' => 'help')),
                        array('label' => 'Links', 'url' => array('/site/page', 'view' => 'resources')),
                        array('label' => 'Über diese Seite', 'url' => array('/site/page', 'view' => 'about')),
                        )),
                    array('url'=>Yii::app()->getModule('user')->loginUrl, 'label'=>Yii::app()->getModule('user')->t("Login"), 'visible'=>Yii::app()->user->isGuest),
                    array('url'=>Yii::app()->getModule('user')->logoutUrl, 'label'=>Yii::app()->getModule('user')->t("Logout").' ('.Yii::app()->user->name.')', 'visible'=>!Yii::app()->user->isGuest, 'items'=>array(
                       array('url'=>Yii::app()->getModule('user')->profileUrl, 'label'=>Yii::app()->getModule('user')->t("Profile"), 'visible'=>!Yii::app()->user->isGuest),
                       array('url'=>array('/user/admin'), 'label'=>'Benutzerverwaltung', 'visible'=>Yii::app()->user->checkAccess('admin')),
                       array('url'=>array('/rights'), 'label'=>'Rechteverwaltung', 'visible'=>Yii::app()->user->checkAccess('admin')),
                    )),
                    
                    // user menus for yii-user-management (yum) extensioné
//                    array('label' => 'Login', 'url' => array('/user/user/login'), 'visible' => Yii::app()->user->isGuest),
//                    array('label' => 'Logout ('.Yii::app()->user->name.')', 'url' => array('/user/user/logout'), 'visible' => !Yii::app()->user->isGuest, 'items'=>array(
//                       array('label' => 'Profil', 'url' => array('/user/user/profile'), 'visible' => !Yii::app()->user->isGuest),
//                    )),
                ),
            ));
            ?>
        </div><!-- head_menu -->

    </div><!-- header -->
    
    <div id="content">
        <?php echo $content; ?>
    </div>

    <div id="footer">
        <div><a href="#" onclick="javascript:installSearchEngine();">Das Wörterbuch als Suche im Browser hinzufügen</a> | Wörterbuch kiswahili//deutsch (v<?php echo Yii::app()->params['version']; ?>) | Copyright &copy; 2010 by Elias Vierneisel</div>
        <br /><div class="statistics"><?php
                        $statistics = wortschatz::model()->statistics();
                        echo 'Gesamtzahl Einträge:' . $statistics['countAll'];
                        echo '<br />Einzelne Kiswahili-Stichwörter: ' . $statistics['countKiswahili'];
                        echo '<br />Einzelne deutsche Stichwörter: ' . $statistics['countDeutsch'];
                        echo '<br />Anzahl Beispiele/Ausdrücke: ' . $statistics['countBeispiele'];
                        print(sprintf("<br /><br />Ausgeführt in %.4f Sek.\n", Yii::app()->timer->getTimer()));
                        ?>
        </div>
    </div><!-- footer -->
    </div><!-- div fixed end -->
    <div>&nbsp;</div>
</body>

</html>
