<?php $this->pageTitle=Yii::app()->name . ' - Begriff anzeigen'; ?>
<div class="actionBar">
    <?php echo CHtml::button('Neuer Begriff',array('submit'=>array('create'))); ?>
    <?php echo CHtml::button('kopieren',array('submit'=>array('copy','id'=>$model->id))); ?>
    <?php echo CHtml::button('ändern',array('submit'=>array('update','id'=>$model->id))); ?>
    <?php echo CHtml::button('löschen',array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Wirklich löschen?')); ?>
</div>

<div id="wort">
    <h4>Begriff</h4>
    <table class="show_table">
    <tr>
	<td><?php echo CHtml::encode($model->getAttributeLabel('kiswahili')).':'; ?></td>
	<td><?php echo CHtml::encode($model->kiswahili);
                echo '<span style="font-style:italic">';
                if ($model->sw_grammatik_id != '') echo ' '.CHtml::encode($model->sw_grammatik_rel->kurz);
                if ($model->sw_fachgebiet_id != '') echo ' '.CHtml::encode($model->sw_fachgebiet_rel->kurz);
                if ($model->sw_gebrauch_id != '') echo ' '.CHtml::encode($model->sw_gebrauch_rel->kurz);
                if ($model->sw_region_id != '') echo ' '.CHtml::encode($model->sw_region_rel->kurz);
                echo '</span>';
                ?>
        </td>
    </tr>
    <tr>
	<td><?php echo CHtml::encode($model->getAttributeLabel('deutsch')).':'; ?></td>
	<td><?php echo CHtml::encode($model->deutsch); ?></td>
    </tr>
    <tr>
	<td><?php echo CHtml::encode($model->getAttributeLabel('deutsch_addition')).':'; ?></td>
	<td><?php echo CHtml::encode($model->deutsch_addition); ?></td>
    </tr>
    <tr>
	<td><?php echo CHtml::encode($model->getAttributeLabel('wortart_id')).':'; ?></td>
	<td><?php echo CHtml::encode($model->wortart_rel->bezeichnung); ?></td>
    </tr>
    <tr>
	<td><?php echo CHtml::encode($model->getAttributeLabel('herkunft_id')).':'; ?></td>
	<td><?php echo CHtml::encode($model->herkunft_rel->bezeichnung); ?></td>
    </tr>
    <tr>
	<td><?php echo CHtml::encode($model->getAttributeLabel('kategorie_id')).':'; ?></td>
	<td><?php echo CHtml::encode($model->kategorie_rel->bezeichnung); ?></td>
    </tr>
    <tr>
	<td><?php echo CHtml::encode($model->getAttributeLabel('anmerkung')).':'; ?></td>
	<td><?php echo CHtml::encode($model->anmerkung); ?></td>
    </tr>
    <tr>
	<td><?php echo CHtml::encode($model->getAttributeLabel('grundwortschatz')); ?></td>
	<td><?php echo CHtml::activeCheckBox($model,'grundwortschatz',array('disabled'=>'disabled')); ?></td>
    </tr>
    </table>
</div>

<div id="wortdetails">
<div id="substantiv">
    <h4>Substantiv</h4>
    <table class="show_table">
    <tr>
	<td><?php echo CHtml::encode($model->getAttributeLabel('noun_class')).':'; ?></td>
	<td><?php echo CHtml::encode($model->noun_class); ?></td>
    </tr>
    <tr>
	<td><?php echo CHtml::encode($model->getAttributeLabel('noun_animate')); ?></td>
	<td><?php echo CHtml::activeCheckBox($model,'noun_animate',array('disabled'=>'disabled')); ?></td>
    </tr>
    <tr>
	<td><?php echo CHtml::encode($model->getAttributeLabel('noun_singular_swahili')).':'; ?></td>
	<td><?php echo CHtml::encode($model->noun_singular_swahili); ?>
	<?php if ($model->noun_singular_swahili != '') { echo "&nbsp;(Kl.:&nbsp;".CHtml::encode($model->noun_class_singular).")";} ?></td>
    </tr>
    <tr>
	<td><?php echo CHtml::encode($model->getAttributeLabel('noun_plural_swahili')).':'; ?></td>
	<td><?php echo CHtml::encode($model->noun_plural_swahili); ?>
	<?php if ($model->noun_plural_swahili != '') { echo "&nbsp;(Kl.:&nbsp;".CHtml::encode($model->noun_class_plural).")";} ?></td>
    </tr>
    <tr>
	<td><?php echo CHtml::encode($model->getAttributeLabel('noun_plural_deutsch')).':'; ?></td>
	<td><?php echo CHtml::encode($model->noun_plural_deutsch); ?></td>
    </tr>
    </table>
</div>

<div id="verb">
    <h4>Verb</h4>
    <table class="show_table">
    <tr>
	<td><?php echo CHtml::encode($model->getAttributeLabel('verb_monosyllabic')); ?></td>
	<td><?php echo CHtml::activeCheckBox($model,'verb_monosyllabic',array('disabled'=>'disabled')); ?></td>
    </tr>
    <tr>
	<td><?php echo CHtml::encode($model->getAttributeLabel('verb_stem')).':'; ?></td>
	<td><?php echo CHtml::encode($model->verb_stem); ?></td>
    </tr>
    <tr>
	<td><?php echo CHtml::encode($model->getAttributeLabel('verb_infinitive')).':'; ?></td>
	<td><?php echo CHtml::encode($model->verb_infinitive); ?></td>
    </tr>
    </table>
</div>
</div>
<div id="wortdetails2">
    <h4>Verb</h4>
    <table class="show_table">
    <tr>
	<td><?php echo CHtml::encode($model->getAttributeLabel('link')).':'; ?></td>
	<td><?php echo CHtml::encode($model->link); ?></td>
    </tr>
    <tr>
	<td><?php echo CHtml::encode($model->getAttributeLabel('quelle')).':'; ?></td>
	<td><?php echo CHtml::encode($model->quelle); ?></td>
    </tr>
    </table>
</div>
<br /><br />
<div><?php echo CHtml::encode('(Datensatz-Nr.: ' .$model->id. ', hinzugefügt von "'.$model->author.'" am ' .$model->timestamp. ')'); ?></div>
<div class="clear"></div>
