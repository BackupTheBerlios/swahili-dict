<?php $this->pageTitle=Yii::app()->name . ' - Suche'; ?>
<?php
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
)); ?>

<div id="searchPage">
    
    <div id="searchBlock">
        <?php echo CHtml::activeTextField($search,'searchq'); ?> 
        <?php echo CHtml::submitButton('Suchen',array('class' => 'submit')); ?>
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
