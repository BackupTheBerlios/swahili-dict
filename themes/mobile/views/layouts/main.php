<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="language" content="en" />
    <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon.ico" />
    <link rel="apple-touch-icon" href="images/template/engage.png"/>
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/reset.css" />
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/iphone.css" type="text/css" />

    <?php
        if (!empty($this->pageDescriptionMetaTag)) {
            Yii::app()->clientScript->registerMetaTag($this->pageDescriptionMetaTag, 'description');
        } else {
            Yii::app()->clientScript->registerMetaTag('Online-Wörterbuch zum Mitmachen. Kiswahili-Deutsch-Übersetzungen suchen, verbessern, hinzufügen. Mit Grammatik-Wiki zum Nachschlagen und Verfassen von Grammatik-Artikeln.', 'description');
        }
    ?>
   
    <title><?php echo $this->pageTitle; ?> - (Mobile)</title>
    
</head>
<body onorientationchange="updateOrientation();">
    <div id="fixed">
    <div id="header">
        <div id="head_title">
            <?php echo CHtml::link('<img src="'.Yii::app()->request->baseUrl.'/images/logo_chocolate-hell_mobile.png" alt="Home" />', array('/wortschatz/search')); ?>
        </div>
        <div id="head_menu">
            
        </div><!-- head_menu -->

    </div><!-- header -->
    
    <div id="content">
        <?php echo $content; ?>
    </div>

    <div id="footer">
        <div>Wörterbuch kiswahili//deutsch (v<?php echo Yii::app()->params['version']; ?>) | Copyright &copy; 2010 by Elias Vierneisel</div>
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
