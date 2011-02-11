<?php
/*
 * Search Form Widget to use in any view
 * 
 */

Yii::app()->clientScript->registerScript('focus', "
                  $('#SearchForm_searchq').focus();
                  $('#SearchForm_searchq').select();
        ");
?>

<div id="searchBlock">
    <div id="search_widget">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
                'id' => 'search-form',
                'action' => Yii::app()->createUrl('wortschatz/search'),
                'enableAjaxValidation' => true,
                'clientOptions' => array('validateonchange' => true, 'validateonsubmit' => false),
                'method' => 'get', //default method is POST
            ));
    ?>

    <?php
    $search = new SearchForm();
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
    echo CHtml::submitButton('Suchen', array('class' => 'submit'));
    ?>

    <?php $this->endWidget(); ?>



    </div><!-- search_widget -->
</div>
