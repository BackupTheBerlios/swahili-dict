<?php
Yii::app()->clientScript->registerScript('focus', "
      $('#wortschatz_kiswahili').focus();
");

//Yii::app()->clientScript->registerScript('tooltips', "
//    $('.formelement').each(function(){
//		var el = $(this);
//		el.tooltip({
//                        events: {
//                          def:     'mouseenter,mouseleave',    // default show/hide events for an element
//                          input:   'focus,blur',               // for all input elements
//                          widget:  'focus,blur',  // select, checkbox, radio, button
//                          tooltip: 'mouseenter,mouseleave',     // the tooltip element
//                        },
//			position : 'center right',
//                        offset : [0, -90],
//			tip : '#tt_'+el.attr('id')
//		});
//	});
//");


// JQuery Script: Which form fields should be visible after choosing "Wortart" (initially)
// Wortarten: 1-Substantiv, 2-Verb, 3-Adjektiv, 4-Adverb, 5-Ausdruck, 6-Beispiel, 7-Sonstige
//
Yii::app()->clientScript->registerScript('initial_display', "
      if ('$model->wortart_id' == '1') {
        $('#substantiv').show();
        $('#herkunft').show();
        }
      if ('$model->wortart_id' == '2') {
        $('#verb').show();
        $('#herkunft').show();
        }
      if ('$model->wortart_id' == '3')  {
        $('#herkunft').show();
        }
      if ('$model->wortart_id' == '4') {
        $('#herkunft').show();
        }
      if ('$model->wortart_id' == '5') {
        
        }
      if ('$model->wortart_id' == '6') {

        }
      if ('$model->wortart_id' == '7') {
        $('#herkunft').show();
        }

      if ('$model->sw_grammatik_id' != '') {
        $('.zusatz').show();
        } else if ('$model->sw_fachgebiet_id' != '') {
        $('.zusatz').show();
        } else if ('$model->sw_gebrauch_id' != '') {
        $('.zusatz').show();
        } else if ('$model->sw_region_id' != '') {
        $('.zusatz').show();
        }
");

Yii::app()->clientScript->registerScript('toggle_wortart', "
  var list_wortart = $('#wortschatz_wortart_id');
        
  list_wortart.change(function(e){
    if (list_wortart.val() == '1') {
      $('#substantiv').fadeIn('slow');
      $('#wortschatz_noun_singular_swahili').val($('#wortschatz_kiswahili').val());
      $('#herkunft').fadeIn('slow');
      $('#verb').fadeOut('slow');
    }
    else if (list_wortart.val() == '2') {
      $('#verb').fadeIn('slow');
      $('#herkunft').fadeIn('slow');
      $('#substantiv').fadeOut('slow');
    }
    else if (list_wortart.val() == '3') {
      $('#substantiv').fadeOut('slow');
      $('#verb').fadeOut('slow');
      $('#herkunft').fadeIn('slow');
    }
    else if (list_wortart.val() == '4') {
      $('#substantiv').fadeOut('slow');
      $('#verb').fadeOut('slow');
      $('#herkunft').fadeIn('slow');
    }
    else if (list_wortart.val() == '5') {
      $('#substantiv').fadeOut('slow');
      $('#verb').fadeOut('slow');
      $('#herkunft').fadeOut('slow');
    }
    else if (list_wortart.val() == '6') {
      $('#substantiv').fadeOut('slow');
      $('#verb').fadeOut('slow');
      $('#herkunft').fadeOut('slow');
    }
    else if (list_wortart.val() == '7') {
      $('#substantiv').fadeOut('slow');
      $('#verb').fadeOut('slow');
      $('#herkunft').fadeIn('slow');
    }
  })
");

Yii::app()->clientScript->registerScript('toggle_additions', "
$('.add_link').click(function(){
	$('.zusatz').toggle();
	return false;
});
");


Yii::app()->clientScript->registerScript('form-help', "
$('.help-link').click(function(){
	$('.form-help').toggle();
	return false;
});
");
?>

<div class="yiiForm">
<p>Felder mit <span class="required">*</span> sind Pflichtfelder.</p>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'wortschatz-form',
        'enableAjaxValidation'=>true,
        'clientOptions'=>array('validateonchange'=>true,'validateonsubmit'=>false),
//	'method'=>'get',  //default method is POST
)); ?>

<?php echo $form->errorSummary($model, 'Eingabefehler:'); ?>

<?php echo $form->error($model,'wortart_id',array('validateOnChange'=>true),true); ?>

<div id="formleft">
<div id="wort">
    <div class="simple">
    <?php echo $form->labelEx($model,'kiswahili'); ?>
    <?php echo $form->textField($model,'kiswahili',array('size'=>'30','class'=>'formelement')); ?>
        <div class="tooltip" id="tt_wortschatz_kiswahili">Bitte <span style="color:red;font-weight: bold">hier</span> den Kiswahili-Begriff eingeben</div>
    <a href="#" class="add_link">Zusätze</a>
    <div class="zusatz" style="display: none">
        <?php echo $form->dropDownList($model,'sw_grammatik_id',CHtml::listData(sw_grammatik::model()->findAll(),'id','kurz'), array('empty'=>'Grammatik')); ?>
        <?php echo $form->dropDownList($model,'sw_fachgebiet_id',CHtml::listData(sw_fachgebiet::model()->findAll(),'id','kurz'), array('empty'=>'Gebiet')); ?>
        <?php echo $form->dropDownList($model,'sw_gebrauch_id',CHtml::listData(sw_gebrauch::model()->findAll(),'id','kurz'), array('empty'=>'Gebrauch')); ?>
        <?php echo $form->dropDownList($model,'sw_region_id',CHtml::listData(sw_region::model()->findAll(),'id','bezeichnung'), array('empty'=>'Region')); ?>
    </div>
    </div>
    <div class="simple">
    <?php echo $form->labelEx($model,'deutsch'); ?>
    <?php echo $form->textField($model,'deutsch',array('size'=>'30','class'=>'formelement')); ?>
        <div class="tooltip" id="tt_wortschatz_deutsch">Bitte <span style="color:red;font-weight: bold">hier</span> den deutschen Begriff eingeben</div>
    
    </div>
    <div class="simple">
    <?php echo $form->labelEx($model,'wortart_id'); ?>
    <?php echo $form->dropDownList($model,'wortart_id',CHtml::listData(wortarten::model()->findAll(),'id','bezeichnung'),array('prompt'=>'','class'=>'formelement')); ?>
        <div class="tooltip"  id="tt_wortschatz_wortart_id">Bitte <span style="color:red;font-weight: bold">Wortart</span> auswählen</div>
    </div>
    <div class="simple" id="herkunft" style="display:none">
    <?php echo $form->labelEx($model,'herkunft_id'); ?>
    <?php echo $form->dropDownList($model,'herkunft_id',CHtml::listData(herkunft::model()->findAll(),'id','bezeichnung'),array('options'=>array('1'=>array('selected'=>true)))); ?>
    </div>
</div>


<div id="wortdetails">
<div id="substantiv" style="display:none">
    <div class="simple">
    <?php echo $form->labelEx($model,'noun_class'); ?>
    <?php echo $form->dropDownList($model,'noun_class',CHtml::listData(klassen::model()->findAll(),'klasse_standard','klasse_standard'),array('prompt'=>'')); ?>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tier/Mensch: <?php echo $form->checkBox($model,'noun_animate'); ?>
    </div>
    <div class="simple">
    <?php echo $form->labelEx($model,'noun_singular_swahili'); ?>
    <?php echo $form->textField($model,'noun_singular_swahili',array('size'=>'30')); ?>
    <?php if ($model->noun_singular_swahili != '') { echo "&nbsp;(Kl.:&nbsp;".CHtml::encode($model->noun_class_singular).")";} ?>
    </div>
    <div class="simple">
    <?php echo $form->labelEx($model,'noun_plural_swahili'); ?>
    <?php echo $form->textField($model,'noun_plural_swahili',array('size'=>'30')); ?>
    <?php if ($model->noun_plural_swahili != '') { echo "&nbsp;(Kl.:&nbsp;".CHtml::encode($model->noun_class_plural).")";} ?>
    </div>
    <div class="simple">
    <?php echo $form->labelEx($model,'noun_plural_deutsch'); ?>
    <?php echo $form->textField($model,'noun_plural_deutsch',array('size'=>'30')); ?>
    </div>
</div>

<div id="verb" style="display:none">
    <div class="simple">
    <?php echo $form->labelEx($model,'verb_monosyllabic'); ?>
    <?php echo $form->checkBox($model,'verb_monosyllabic'); ?>
    </div>
    <div class="simple" id="verbstem">
    <?php echo $form->labelEx($model,'verb_stem'); ?>
    <?php echo $form->textField($model,'verb_stem',array('size'=>'30','readonly'=>'readonly')); ?>
    </div>
    <div class="simple">
    <?php echo $form->labelEx($model,'verb_infinitive'); ?>
    <?php echo $form->textField($model,'verb_infinitive',array('size'=>'30','readonly'=>'readonly')); ?>
    </div>
</div>
</div> <!--wortdetails -->

<div class="admin" style="display:none">
    <div class="simple">
    <?php echo $form->labelEx($model,'grundwortschatz'); ?>
    <?php echo $form->checkBox($model,'grundwortschatz'); ?>
    </div>
</div>

</div> <!-- formleft -->

<div id="formright">
<div id="wort_meta">
    <div class="simple">
    <?php echo $form->labelEx($model,'anmerkung'); ?>
    <?php echo $form->textArea($model,'anmerkung',array('rows'=>'3','cols'=>'35')); ?>
    </div>
    <div class="simple">
    <?php echo $form->labelEx($model,'link'); ?>
    <?php echo $form->textField($model,'link',array('size'=>'30')); ?>
    </div>
    <div class="simple">
    <?php echo $form->hiddenField($model,'author',array('size'=>'30','readonly'=>'readonly','value'=>Yii::app()->user->name)); ?>
    </div>
    <div class="simple">
    <?php echo $form->labelEx($model,'kategorie_id'); ?>
    <?php echo $form->dropDownList($model,'kategorie_id',CHtml::listData(kategorien::model()->findAll(),'id','bezeichnung'),array('options'=>array('1'=>array('selected'=>true)))); ?>
    <!-- <?php echo $form->checkBoxList($model,'kategorie_id',CHtml::listData(kategorien::model()->findAll(),'id','bezeichnung')); ?> -->
    </div>
</div>
</div> <!-- formright -->

<!--
<div style="clear:both">
    <div style="padding:60px 0 0 0;">
        <?php echo $form->labelEx($model,'quelle'); ?>
        <?php echo $form->textField($model,'quelle',array('size'=>'30')); ?>
    </div>
</div>
-->


<div class="action">
<?php echo CHtml::submitButton($update ? 'Änderung speichern' : 'Begriff hinzufügen'); ?>
</div>

<?php $this->endWidget(); ?>

</div><!-- yiiForm -->

<br /><br />
<div><a href="#" class="help-link">Hilfe zur Benutzung</a></div>
<br />
<div class="form-help" style="display:none;">
    <h3>Hilfreiche Links</h3>
    <p>
    <?php echo CHtml::link('www.canoo.net', 'http://www.canoo.net', array('target'=>'_blank')); ?> (Deutsche Grammatik & Rechtschreibung)<br />
    <?php echo CHtml::link('Online Swahili-English Dictionary', 'http://africanlanguages.com/swahili/', array('target'=>'_blank')); ?> (Zur Überprüfung der Übersetzung)
    </p>
 <h3>Details zur Eingabe</h3>
<ul>
    <li><span style="font-weight: bold;">Feld 'Kiswahili'</span><br>
        <ul>
            <li><span style="font-weight: bold;">Substantive</span> müssen in
                Kleinschreibung im Singular angeben werden (ausser wenn nur Plural)</li>
            <li><span style="font-weight: bold;">Verben</span> müssen im
                Infinitiv aber ohne die Vorsilbe 'ku' stattdessen mit vorangehendem
                Bindestrich ('-') angeben werden. Beispiel: -fanya</li>
        </ul>
    </li>
    <li><span style="font-weight: bold;">Feld 'Anmerkung'</span><br>
        Die Anmerkung wird in den Suchergebnissen angezeigt</li>
    <li><span style="font-weight: bold;">Feld 'siehe auch'</span><br>
        Ein anderes Kiswahili-Stichwort aus dem Wortschatz angeben, das mit dem Begriff in Zusammenhang
        steht. Diese Wörter werden im Suchergebnis als Links angezeigt.<br>
    </li>
</ul>
</div>
