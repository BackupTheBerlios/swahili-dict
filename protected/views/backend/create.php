<?php $this->pageTitle=Yii::app()->name . ' - Neuen Begriff hinzufügen'; ?>

<?php if(isset($copy)) {
    $update=false; //Beschriftung des Submit-Buttons im _form: "Hinzufügen"
    $title='<h2>Kopieren</h2><p>Erstellt eine Kopie des Eintrags "' .CHtml::encode($model->kiswahili) . '" und fügt sie dem Wörterbuch als neuen Begriff hinzu.</p>';
} else {
    $update=true; //Beschriftung des Submit-Buttons im _form: "Ändern"
    $title='<h2>Begriff hinzufügen</h2>';
}
?>

<?php echo $title ?>

<?php echo $this->renderPartial('_form', array(
	'model'=>$model,
	'update'=>$update,
)); ?>
