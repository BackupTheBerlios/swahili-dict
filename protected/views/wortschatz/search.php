<?php
$statistics = wortschatz::model()->statistics();
$this->pageTitle=Yii::app()->name . ' - Online-Suche nach '.$statistics['countAll'].' Übersetzungen';
?>
<?php
$this->layout='_2cols';
$this->portlets['WelcomeText'] = array(); // fuegt dem Portlets array ein key-value Paar hinzu
?>

<?php
Yii::app()->clientScript->registerScript('focus', "
      $('#SearchForm_searchq').focus();
      $('#SearchForm_searchq').select();
");
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'search-form',
        'enableAjaxValidation'=>true,
        'clientOptions'=>array('validateonchange'=>true,'validateonsubmit'=>false),
	'method'=>'get',  //default method is POST
        'htmlOptions'=>array(
        'autocomplete'=>'off',
        ),
)); ?>

<div id="searchPage">
    
    <div id="searchBlock">
        <?php
    $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
        'model' => $search,
//        'name' => 'searchq',
        'attribute' => 'searchq',
        'value' => '',
//        'cssFile'=>false,
        'source' => $this->createUrl('wortschatz/autocomplete'),
        // additional javascript options for the autocomplete plugin
        'options' => array(
//            'showAnim' => 'fold',
            'delay'=>'100',
            'minLength'=>'2',
        ),
        'htmlOptions'=>array(
        ),
    ));
   ?>
 
        <?php echo CHtml::submitButton('Suchen',array('class' => 'submit')); ?>

        <span class="detaillink"><?php echo CHtml::link('Detailsuche', array('/wortschatz/detailedSearch'), array('class' => 'test')); ?></span>
    </div><!-- searchBlock -->

    <?php echo $form->error($search,'searchq'); ?>
    <?php if (isset($errortext)) echo '<div class="error">'.$errortext.'</div>'; ?>

    <?php if (isset($models)) {
            include('results.php');
        }
        ?>
    
</div><!-- searchPage -->
<?php $this->endWidget(); ?>
<br /><br /><br />

<div style="clear:both"></div>
