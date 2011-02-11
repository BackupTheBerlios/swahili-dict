<h1>Tabelle Adjektive</h1>

<div style="width:100%"> <!-- if the column width should be exact put px here -->
    <?php
    $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'deklinationen-grid',
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
                    
            ),
    ));
    ?>
</div>