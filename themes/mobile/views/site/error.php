<?php
$this->pageTitle=Yii::app()->name . ' - Error';
?>

<h2>Error <?php echo $code; ?></h2>

<div class="error">
<?php
echo CHtml::encode($message);
if(Yii::app()->user->checkAccess('admin')) {
    echo '<br /><br />File: ' . CHtml::encode($file);
    echo '<br />Line: ' . CHtml::encode($line);
    echo '<br />Source: ' . CHtml::encode($source);
    echo '<br />Trace: ' . CHtml::encode($trace);
}
?>
</div>