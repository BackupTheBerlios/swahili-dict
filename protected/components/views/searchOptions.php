<?php
//$this->widget('zii.widgets.jui.CJuiAccordion', array(
//    'cssFile'=>'',
//    'panels'=>array(
//        'panel 1'=>'content for panel 1',
//        'panel 2'=>'content for panel 2',
//        // panel 3 contains the content rendered by a partial view
////        'panel 3'=>$this->renderPartial('list',null,true),
//    ),
//    // additional javascript options for the accordion plugin
//    'options'=>array(
//        'animated'=>'bounceslide',
//    ),
//));
 ?>

<p>Suche einschränken</p>


<div class="adv_row">
<?php echo CHtml::activeDropDownList($search,'wortart',CHtml::listData(wortarten::model()->findAll(),'bezeichnung','bezeichnung'),array('prompt'=>'alle Wortarten')); ?>
</div>
<div class="adv_row">
<?php echo CHtml::activeDropDownList($search,'kategorie',CHtml::listData(kategorien::model()->findAll(),'bezeichnung','bezeichnung'),array('prompt'=>'alle Kategorien')); ?>
</div>
<!--
activeCheckBox: <?php echo CHtml::activeCheckBox($search,'wortart',array('value'=>'Substantiv')); ?><br /><br />

<?php echo CHtml::activeCheckBoxList($search,'wortart',CHtml::listData(wortarten::model()->findAll(),'bezeichnung','bezeichnung'),array('template'=>'{input}{label}','separator'=>'<br />','checkAll'=>'alle Wortarten')); ?>
-->
