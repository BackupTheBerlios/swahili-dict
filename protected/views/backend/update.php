<?php $this->pageTitle=Yii::app()->name . ' - Begriff ändern'; ?>
<h2>Ändern</h2><p>Änderung des Eintrags "<?php echo CHtml::encode($model->kiswahili) ?>"</p>

<?php echo $this->renderPartial('_form', array(
	'model'=>$model,
	'update'=>true, //Beschriftung des Submit-Buttons im _form: "Ändern"
)); ?>
