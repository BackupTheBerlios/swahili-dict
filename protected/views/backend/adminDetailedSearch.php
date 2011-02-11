<?php $this->pageTitle=Yii::app()->name . ' - Admin Spezialsuche'; ?>
div class="search-form">
    <p>You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
        or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.</p>

    <?php $this->renderPartial('_search',array(
            'model'=>$model,
    )); ?>
</div> <!-- end of search-form -->


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
    ));
    ?>

    <?php
    // small script to process the selected row. Add "alert(test[0]);" to the the function will display the (first) id
    Yii::app()->clientScript->registerScript("selectedRows","function select() { var test = new Array();  test=$.fn.yiiGridView.getSelection('wortschatz-grid'); };",4);
    ?>
</div>
