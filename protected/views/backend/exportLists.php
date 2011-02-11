<?php $this->pageTitle=Yii::app()->name . ' - Wortliste exportieren'; ?>

<h2>Export des W&ouml;rterbuches</h2>

<p>Sie können hier die Datei "wortschatz-komplett.csv" herunterladen. Sie enthält das gesamte Wörterbuch im CSV-Format. Klicken Sie einfach auf den Link unten und speichern Sie die Datei auf Ihrem Computer ab. Anschliessend können Sie die Datei in Excel (oder OpenOffice Calc) öffnen.</p>

<?php $size = ''; $size = $file->size; ?>
<?php echo CHtml::link('wortschatz-komplett.csv herunterladen', Yii::app()->baseUrl .'/downloads/wortschatz-komplett.csv'); echo (' ('.$size.')'); ?>
