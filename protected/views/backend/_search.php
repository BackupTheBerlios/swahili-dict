<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
        'action'=>Yii::app()->createUrl($this->route),
        'method'=>'get',
        'stateful'=>true,
	'id'=>'wortschatz-completeList-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

        <div class="row">
		<?php echo $form->label($model,'timestamp'); ?>
		<?php echo $form->textField($model,'timestamp'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'kiswahili'); ?>
		<?php echo $form->textField($model,'kiswahili'); ?>
		<?php echo $form->error($model,'kiswahili'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'deutsch'); ?>
		<?php echo $form->textField($model,'deutsch'); ?>
		<?php echo $form->error($model,'deutsch'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'wortart_id'); ?>
		<?php // echo $form->textArea($model,'wortart_id',array('rows'=>6, 'cols'=>50)); ?>
                <?php echo $form->dropDownList($model,'wortart_id',CHtml::listData(wortarten::model()->findAll(),'id','bezeichnung'),array('prompt'=>'alle Wortarten')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'herkunft_id'); ?>
                <?php echo $form->dropDownList($model,'herkunft_id',CHtml::listData(herkunft::model()->findAll(),'id','bezeichnung'),array('prompt'=>'alle Sprachen')); ?>
		<?php echo $form->error($model,'herkunft_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sw_grammatik_id'); ?>
		<?php echo $form->textField($model,'sw_grammatik_id'); ?>
		<?php echo $form->error($model,'sw_grammatik_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sw_fachgebiet_id'); ?>
		<?php echo $form->textField($model,'sw_fachgebiet_id'); ?>
		<?php echo $form->error($model,'sw_fachgebiet_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sw_gebrauch_id'); ?>
		<?php echo $form->textField($model,'sw_gebrauch_id'); ?>
		<?php echo $form->error($model,'sw_gebrauch_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sw_region_id'); ?>
		<?php echo $form->textField($model,'sw_region_id'); ?>
		<?php echo $form->error($model,'sw_region_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'noun_animate'); ?>
		<?php echo $form->textField($model,'noun_animate'); ?>
		<?php echo $form->error($model,'noun_animate'); ?>
	</div>

        <div class="row">
		<?php echo $form->label($model,'noun_class'); ?>
		<?php echo $form->dropDownList($model,'noun_class',CHtml::listData(klassen::model()->findAll(array('order'=>'id')),'klasse_standard','klasse_standard'),array('prompt'=>'alle Klassen')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'noun_class_singular'); ?>
		<?php echo $form->textField($model,'noun_class_singular'); ?>
		<?php echo $form->error($model,'noun_class_singular'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'noun_class_plural'); ?>
		<?php echo $form->textField($model,'noun_class_plural'); ?>
		<?php echo $form->error($model,'noun_class_plural'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'verb_monosyllabic'); ?>
		<?php echo $form->textField($model,'verb_monosyllabic'); ?>
		<?php echo $form->error($model,'verb_monosyllabic'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kategorie_id'); ?>
		<?php echo $form->dropDownList($model,'kategorie_id',CHtml::listData(kategorien::model()->findAll(),'id','bezeichnung'),array('prompt'=>'alle Themen')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'grundwortschatz'); ?>
		<?php echo $form->textField($model,'grundwortschatz'); ?>
		<?php echo $form->error($model,'grundwortschatz'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'deutsch_addition'); ?>
		<?php echo $form->textField($model,'deutsch_addition'); ?>
		<?php echo $form->error($model,'deutsch_addition'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'noun_singular_swahili'); ?>
		<?php echo $form->textField($model,'noun_singular_swahili'); ?>
		<?php echo $form->error($model,'noun_singular_swahili'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'noun_plural_swahili'); ?>
		<?php echo $form->textField($model,'noun_plural_swahili'); ?>
		<?php echo $form->error($model,'noun_plural_swahili'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'noun_plural_deutsch'); ?>
		<?php echo $form->textField($model,'noun_plural_deutsch'); ?>
		<?php echo $form->error($model,'noun_plural_deutsch'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'verb_stem'); ?>
		<?php echo $form->textField($model,'verb_stem'); ?>
		<?php echo $form->error($model,'verb_stem'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'verb_infinitive'); ?>
		<?php echo $form->textField($model,'verb_infinitive'); ?>
		<?php echo $form->error($model,'verb_infinitive'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'anmerkung'); ?>
		<?php echo $form->textField($model,'anmerkung'); ?>
		<?php echo $form->error($model,'anmerkung'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'author'); ?>
                <?php echo $form->dropDownList($model,'author',CHtml::listData(wortschatz::model()->findAll(),'author','author'),array('prompt'=>'alle Autoren')); ?>
		<?php echo $form->error($model,'author'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'link'); ?>
		<?php echo $form->textField($model,'link'); ?>
		<?php echo $form->error($model,'link'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'quelle'); ?>
		<?php echo $form->textField($model,'quelle'); ?>
		<?php echo $form->error($model,'quelle'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Suchen'); ?><?php echo CHtml::resetButton('Reset'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
