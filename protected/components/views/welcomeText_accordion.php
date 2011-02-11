<?php

$panel1 = '
    <p>Dies ist unfertige Version. Sie ist (noch) nicht zur öffentlichen Nutzung gedacht. Wenn Sie beim Aufbau mithelfen möchten (z.B. neue Einträge hinzufügen oder bestehende Einträge überarbeiten), schreiben Sie mir ein Email: <br />
    admin (at) ndanda-projekt.info
    </p>
    ';

$panel2 = '
    <p>Gesucht wird nach allen Wörterbucheinträgen, in denen der Suchbegriff enthalten ist.
    Auch wenn es sich dabei um einen Wortteil handelt (Suchbegriff "fuata" findet sowohl "-fuata" als auch "-fuatana" etc.).</p>
    ';

$panel3 = '
    <p>Haben Sie einen Fehler entdeckt? Ich würde mich freuen, wenn Sie mir Bescheid geben. (admin (at) ndanda-projekt.info)</p>
    ';

$this->widget('zii.widgets.jui.CJuiAccordion', array(
    'cssFile'=>'',
    'panels'=>array(
        'Willkommen'=>$panel1,
        'Suchhilfe'=>$panel2,
        'Fehler gefunden?'=>$panel3,
    ),
    // additional javascript options for the accordion plugin
    'options'=>array(
        'animated'=>'bounceslide',
    ),
));


 ?>