<?php $this->pageTitle=Yii::app()->name . ' - Detailsuche'; ?>
<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
        'stateful'=>true,
)); ?>

        <div class="row">
		<?php echo $form->label($model,'kiswahili'); ?>
		<?php echo $form->textField($model,'kiswahili'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'deutsch'); ?>
		<?php echo $form->textField($model,'deutsch'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'wortart_id'); ?>
		<?php // echo $form->textArea($model,'wortart_id',array('rows'=>6, 'cols'=>50)); ?>
                <?php echo $form->dropDownList($model,'wortart_id',CHtml::listData(wortarten::model()->findAll(),'id','bezeichnung'),array('prompt'=>'alle Wortarten')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'noun_class'); ?>
		<?php echo $form->dropDownList($model,'noun_class',CHtml::listData(klassen::model()->findAll(array('order'=>'id')),'klasse_standard','klasse_standard'),array('prompt'=>'alle Klassen')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kategorie_id'); ?>
		<?php echo $form->dropDownList($model,'kategorie_id',CHtml::listData(kategorien::model()->findAll(),'id','bezeichnung'),array('prompt'=>'alle Themen')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'anmerkung'); ?>
		<?php echo $form->textArea($model,'anmerkung',array('rows'=>3, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Suchen'); ?><?php echo CHtml::resetButton('Reset'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'detail-grid',
        'dataProvider'=>$model->search(),
        'template'=>'{summary} {pager} {items}',
        'cssFile'=>Yii::app()->baseUrl . '/css/customGridView.css',
        'summaryText'=>'Ergebnis {start}-{end} von insgesamt {count}.',
        'selectableRows'=>'0', //0=none, 1=only one row, row 2=multiple rows
        'pager'=>array('header'=>false,'cssFile'=>Yii::app()->baseUrl . '/css/customPager.css', 'firstPageLabel'=>'Anfang','prevPageLabel'=>'< zurück','nextPageLabel'=>'weiter >','lastPageLabel'=>'Ende',),
        'selectionChanged'=>'select',
        //'ajaxUpdate'=>false,
        'columns'=>array(
                array(
                        'name'=>'kiswahili',
                        'htmlOptions'=>array('style'=>'width:160px'),
                ),
                array(
                        'name'=>'sw_grammatik_id',
                        'header'=>'',
//                            'value'=>'$data->sw_grammatik_rel->kurz',
                        'filter'=>CHtml::activeDropDownList($model,'sw_grammatik_id',CHtml::listData(sw_grammatik::model()->findAll(),'id','kurz'), array('prompt'=>'')),
                        'htmlOptions'=>array('style'=>'width:10px'),
                ),
                array(
                        'name'=>'sw_fachgebiet_id',
                        'header'=>'',
//                            'value'=>'$data->sw_fachgebiet_rel->kurz',
                        'filter'=>CHtml::activeDropDownList($model,'sw_fachgebiet_id',CHtml::listData(sw_fachgebiet::model()->findAll(),'id','kurz'), array('prompt'=>'')),
                        'htmlOptions'=>array('style'=>'width:10px'),
                ),
                array(
                        'name'=>'sw_gebrauch_id',
                        'header'=>'',
//                            'value'=>'$data->sw_gebrauch_rel->kurz',
                        'filter'=>CHtml::activeDropDownList($model,'sw_gebrauch_id',CHtml::listData(sw_gebrauch::model()->findAll(),'id','kurz'), array('prompt'=>'')),
                        'htmlOptions'=>array('style'=>'width:10px'),
                ),
                array(
                        'name'=>'sw_region_id',
                        'header'=>'',
//                            'value'=>'$data->sw_region_rel->kurz',
                        'filter'=>CHtml::activeDropDownList($model,'sw_region_id',CHtml::listData(sw_region::model()->findAll(),'id','kurz'), array('prompt'=>'')),
                        'htmlOptions'=>array('style'=>'width:10px'),
                ),
                array(
                        'name'=>'deutsch',
                        'htmlOptions'=>array('style'=>'width:160px'),
                ),
                array(
                        'name'=>'wortart_id',
                        'value'=>'$data->wortart_rel->bezeichnung',
                        'filter'=>CHtml::activeDropDownList($model,'wortart_id',CHtml::listData(wortarten::model()->findAll(),'id','bezeichnung'),array('prompt'=>'')),
                        'htmlOptions'=>array('style'=>'width:120px'),
                ),
                array(
                        'name'=>'herkunft_id',
                        'value'=>'$data->herkunft_rel->bezeichnung',
                        'filter'=>CHtml::activeDropDownList($model,'herkunft_id',CHtml::listData(herkunft::model()->findAll(),'id','kurz'),array('prompt'=>'')),
                        'htmlOptions'=>array('style'=>'width:70px'),
                ),
                array(
                        'name'=>'noun_class',
//                        'value'=>'$data->wortart_rel->bezeichnung',
                        'filter'=>CHtml::activeDropDownList($model,'noun_class',CHtml::listData(klassen::model()->findAll(array('order'=>'id')),'klasse_standard','klasse_standard'),array('prompt'=>'')),
                        'htmlOptions'=>array('style'=>'width:10px'),
                ),
                array(
                        'name'=>'kategorie_id',
                        'value'=>'$data->kategorie_rel->bezeichnung',
                        'filter'=>CHtml::activeDropDownList($model,'kategorie_id',CHtml::listData(kategorien::model()->findAll(),'id','bezeichnung'),array('prompt'=>'')),
                        'htmlOptions'=>array('style'=>'width:120px'),
                ),
                array(
                        'name'=>'anmerkung',
                        'htmlOptions'=>array('style'=>'width:220px'),
                ),
        ),
));
?>
