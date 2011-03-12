<?php $this->pageTitle=Yii::app()->name . ' - Begriffe verwalten'; ?>
<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('wortschatz-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Begriffe verwalten</h1>

<div style="width:100%"> <!-- if the column width should be exact put px here -->
    <?php
    $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'wortschatz-grid',
            'dataProvider'=>$model->search(),
            'filter'=>$model,
            'template'=>'{summary} {pager} {items}',
            'cssFile'=>Yii::app()->baseUrl . '/css/customGridView.css',
            'summaryText'=>'Ergebnis {start}-{end} von insgesamt {count}.',
            'selectableRows'=>'2', //0=none, 1=only one row, row 2=multiple rows
            'selectionChanged'=>'select',
            'pager'=>array('header'=>false,'cssFile'=>Yii::app()->baseUrl . '/css/customPager.css', 'firstPageLabel'=>'Anfang','prevPageLabel'=>'< zurück','nextPageLabel'=>'weiter >','lastPageLabel'=>'Ende',),
            //'ajaxUpdate'=>false,
            'columns'=>array(
                    array(
//                        'header'=>'',
                            'class'=>'CCheckBoxColumn',
//                        'template'=>'{view} {update} {delete}',
//                        'htmlOptions'=>array('style'=>'width:60px; white-space:nowrap;'),
                    ),
                    array(
                            'header'=>'Aktion',
                            'class'=>'CButtonColumn',
                            'template'=>'{view} {update} {delete}',
                            'htmlOptions'=>array('style'=>'width:60px; white-space:nowrap;'),
                    ),
                    array(
                            'name'=>'id',
                            'htmlOptions'=>array('style'=>'width:10px'),
                    ),
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
                            'name'=>'deutsch_addition',
                            'header'=>false,
                            'htmlOptions'=>array('style'=>'width:10px'),
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
                            'name'=>'noun_animate',
                            'header'=>'A',
                            'type'=>'raw',
                            'value'=>'CHtml::activeCheckBox($data,"noun_animate",array("disabled"=>"disabled"))',
                            'htmlOptions'=>array('style'=>'width:10px'),
                    ),
                    array(
                            'name'=>'noun_singular_swahili',
                            'header'=>'Singular',
                            'htmlOptions'=>array('style'=>'width:160px'),
                    ),
                    array(
                            'name'=>'noun_class_singular',
                            'header'=>'Kl.',
                            'htmlOptions'=>array('style'=>'width:15px'),
                    ),
                    array(
                            'name'=>'noun_plural_swahili',
                            'header'=>'Plural (Sw)',
                            'htmlOptions'=>array('style'=>'width:160px'),
                    ),
                    array(
                            'name'=>'noun_class_plural',
                            'header'=>'Kl.',
                            'htmlOptions'=>array('style'=>'width:15px'),
                            'filter'=>CHtml::activeDropDownList($model,'noun_class_plural',CHtml::listData(wortschatz::model()->findAll(),'noun_class_plural','noun_class_plural'),array('prompt'=>'')),
                    ),
                    array(
                            'name'=>'noun_plural_deutsch',
                            'header'=>'Plural (D)',
                            'htmlOptions'=>array('style'=>'width:160px'),
                    ),
                    array(
                            'name'=>'verb_monosyllabic',
                            'header'=>'M',
                            'type'=>'raw',
                            'value'=>'CHtml::activeCheckBox($data,"verb_monosyllabic",array("disabled"=>"disabled"))',
                            'htmlOptions'=>array('style'=>'width:10px'),
                    ),
                    array(
                            'name'=>'verb_stem',
                            'htmlOptions'=>array('style'=>'width:100px'),
                    ),
                    array(
                            'name'=>'verb_infinitive',
                            'htmlOptions'=>array('style'=>'width:100px'),
                    ),
                    array(
                            'name'=>'kategorie_id',
                            'value'=>'$data->kategorie_rel->bezeichnung',
                            'filter'=>CHtml::activeDropDownList($model,'kategorie_id',CHtml::listData(kategorien::model()->findAll(),'id','bezeichnung'),array('prompt'=>'')),
                            'htmlOptions'=>array('style'=>'width:120px'),
                    ),
                    array(
                            'name'=>'grundwortschatz',
                            'header'=>'G',
                            'type'=>'raw',
                            'value'=>'CHtml::activeCheckBox($data,"grundwortschatz",array("disabled"=>"disabled"))',
                            'htmlOptions'=>array('style'=>'width:10px'),
                    ),
                    array(
                            'name'=>'anmerkung',
                            'htmlOptions'=>array('style'=>'width:220px'),
                    ),
                    array(
                            'name'=>'link',
                            'htmlOptions'=>array('style'=>'width:80px'),
                    ),
                    array(
                            'name'=>'quelle',
                            'htmlOptions'=>array('style'=>'width:100px'),
                    ),
                    array(
                            'name'=>'author',
                            'htmlOptions'=>array('style'=>'width:30px'),
                    ),
            ),
    ));
    ?>
    
    <?php
    // small script to process the selected row. Add "alert(test[0]);" to the the function will display the (first) id
    Yii::app()->clientScript->registerScript("selectedRows","function select() { var test = new Array();  test=$.fn.yiiGridView.getSelection('wortschatz-grid'); };",4);
    ?>
</div>
