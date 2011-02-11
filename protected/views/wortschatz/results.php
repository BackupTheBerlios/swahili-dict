<div class='statistics'>
    Anzahl Ergebnisse:
    <?php echo ($count); ?> von <?php echo $countAll; ?>
    <?php if ($query != '%') echo " (Suchbegriff:  ". $query .")";?>
</div>


<?php if ($count != 0) { ?>
<table class="resultTable">
  <thead>
  <tr>
    <th>&nbsp;</th>
	<th class='resultsSwahili'>Kiswahili</th>
	<th class='resultsDeutsch'><?php echo $sort_exact->link('deutsch'); ?></th>
        <th class='resultsAnmerkung'></th>
  </tr>
  </thead>
  <tbody>


<?php if (count($models_exact) != 0) { ?>
<tr>
    <td colspan="3" class="resultsHeading">Exakte Treffer</td>
    <td class="resultsAnmerkung"></td>
</tr>
<?php
foreach($models_exact as $n=>$model):
	if ($model->noun_plural_swahili != "" && $model->noun_singular_swahili != "") { $plural = " <b>(".$model->noun_plural_swahili.")</b>"; } else { $plural = ""; }

	if ($model->herkunft_id != '' AND $model->herkunft_id != 0 AND $model->herkunft_id != 1) { $herkunft = " <span class='addition'>&lt;".$model->herkunft_rel->kurz ."&gt;</span>"; } else { $herkunft = ""; }
        if ($model->sw_grammatik_id != '') { $grammatik = " <span class='addition'>".$model->sw_grammatik_rel->kurz ."</span>"; } else { $grammatik = ""; }
        if ($model->sw_fachgebiet_id != '') { $fachgebiet = " <span class='addition'>".$model->sw_fachgebiet_rel->kurz ."</span>"; } else { $fachgebiet = ""; }
        if ($model->sw_gebrauch_id != '') { $gebrauch = " <span class='addition'>".$model->sw_gebrauch_rel->kurz ."</span>"; } else { $gebrauch = ""; }
        if ($model->sw_region_id != '') { $region = " <span class='addition'>".$model->sw_region_rel->kurz ."</span>"; } else { $region = ""; }
        $additions = $herkunft . $grammatik . $fachgebiet . $gebrauch . $region;

        if ($model->noun_class != "") { $class = " <span class='noun_class'><a href='".Yii::app()->baseUrl."/index.php/site/page/view/classes'>" . $model->noun_class . "</a></span>"; } else { $class = ""; }
	if ($model->wortart_id != "") { $wortart = " <span style='color:#6A9ACD;font-weight:bold'>" .$model->wortart_rel->bezeichnung. "</span>"; }  else { $wortart = ""; }

	if ($model->anmerkung=="") { $anmerkung = ""; } else { $anmerkung = "<br />" .$model->anmerkung. "<br />"; }

?>
  <tr class="<?php echo $n%2?'even':'odd';?>">
    <td class="col_details">
        <div id="details"><a href="<?php echo(Yii::app()->baseUrl)?>/index.php/wortschatz/viewDetails/id/<?php echo $model->id ?>"><img src="<?php echo(Yii::app()->baseUrl)?>/images/information.png" alt="" /></a></div>
	</td>
        <td><b><?php echo wortschatz::model()->makeSearchLink($model->kiswahili) ?></b><?php echo $plural.$additions.$class.$wortart; ?></td>
	<td><?php echo wortschatz::model()->makeSearchLink(CHtml::encode($model->deutsch)); ?></td>
        <td class="resultsAnmerkung"><?php echo CHtml::encode($model->anmerkung); ?></td>
  </tr>
<?php endforeach; ?>
<?php } //endif ?>


<?php if ((count($models_exact) != 0) AND (count($models) != 0)) { ?>
<tr>
    <td colspan="3" class="resultsHeading">Weitere Treffer</td>
    <td class="resultsAnmerkung"></td>
</tr>
<?php } //endif ?>

<?php if (count($models) != 0) { 
foreach($models as $n=>$model):
	if ($model->noun_plural_swahili != "" && $model->noun_singular_swahili != "") { $plural = " <b>(".$model->noun_plural_swahili.")</b>"; } else { $plural = ""; }

        if ($model->herkunft_id != '' AND $model->herkunft_id != 0 AND $model->herkunft_id != 1) { $herkunft = " <span class='addition'>&lt;".$model->herkunft_rel->kurz ."&gt;</span>"; } else { $herkunft = ""; }
        if ($model->sw_grammatik_id != "") { $grammatik = " <span class='addition' title='".$model->sw_grammatik_rel->bezeichnung."'>".$model->sw_grammatik_rel->kurz ."</span>"; } else { $grammatik = ""; }
        if ($model->sw_fachgebiet_id != "") { $fachgebiet = " <span class='addition' title='".$model->sw_fachgebiet_rel->bezeichnung."'>".$model->sw_fachgebiet_rel->kurz ."</span>"; } else { $fachgebiet = ""; }
        if ($model->sw_gebrauch_id != "") { $gebrauch = " <span class='addition' title='".$model->sw_gebrauch_rel->bezeichnung."'>".$model->sw_gebrauch_rel->kurz ."</span>"; } else { $gebrauch = ""; }
        if ($model->sw_region_id != "") { $region = " <span class='addition' title='".$model->sw_region_rel->bezeichnung."'>".$model->sw_region_rel->kurz ."</span>"; } else { $region = ""; }
        $additions = $herkunft . $grammatik . $fachgebiet . $gebrauch . $region;

        if ($model->noun_class != "") { $class = " <span class='noun_class'><a href='".Yii::app()->baseUrl."/index.php/site/page/view/classes'>" . $model->noun_class . "</a></span>"; } else { $class = ""; }
	if ($model->wortart_id != "") { $wortart = " <span style='color:#6A9ACD;font-weight:bold'>" .$model->wortart_rel->bezeichnung. "</span>"; }  else { $wortart = ""; }
	
	if ($model->anmerkung=="") { $anmerkung = ""; } else { $anmerkung = "<br />" .$model->anmerkung. "<br />"; }
 
?>
  <tr class="<?php echo $n%2?'even':'odd';?>">
    <td class="col_details">
        <div id="details"><a href="<?php echo(Yii::app()->baseUrl)?>/index.php/wortschatz/viewDetails/id/<?php echo $model->id ?>"><img src="<?php echo(Yii::app()->baseUrl)?>/images/information.png" alt="" /></a></div>
	</td>
	<td><b><?php echo wortschatz::model()->makesearchLink($model->kiswahili) ?></b><?php echo $plural.$additions.$class.$wortart; ?></td>
	<td><?php echo wortschatz::model()->makeSearchLink(CHtml::encode($model->deutsch)); ?></td>
        <td class="resultsAnmerkung"><?php echo CHtml::encode($model->anmerkung); ?></td>
  </tr>
<?php endforeach; ?>
<?php } //endif ?>



<?php if (((count($models_exact) != 0) OR (count($models) != 0)) AND (count($models_like) != 0)) { ?>
<tr>
    <td colspan="3" class="resultsHeading">Wortteilsuche</td>
    <td class="resultsAnmerkung"></td>
</tr>
<?php } //endif ?>

<?php if (count($models_like) != 0) {
foreach($models_like as $n=>$model):
	if ($model->noun_plural_swahili != "" && $model->noun_singular_swahili != "") { $plural = " <b>(".$model->noun_plural_swahili.")</b>"; } else { $plural = ""; }

        if ($model->herkunft_id != '' AND $model->herkunft_id != 0 AND $model->herkunft_id != 1) { $herkunft = " <span class='addition'>&lt;".$model->herkunft_rel->kurz ."&gt;</span>"; } else { $herkunft = ""; }
        if ($model->sw_grammatik_id != "") { $grammatik = " <span class='addition' title='".$model->sw_grammatik_rel->bezeichnung."'>".$model->sw_grammatik_rel->kurz ."</span>"; } else { $grammatik = ""; }
        if ($model->sw_fachgebiet_id != "") { $fachgebiet = " <span class='addition' title='".$model->sw_fachgebiet_rel->bezeichnung."'>".$model->sw_fachgebiet_rel->kurz ."</span>"; } else { $fachgebiet = ""; }
        if ($model->sw_gebrauch_id != "") { $gebrauch = " <span class='addition' title='".$model->sw_gebrauch_rel->bezeichnung."'>".$model->sw_gebrauch_rel->kurz ."</span>"; } else { $gebrauch = ""; }
        if ($model->sw_region_id != "") { $region = " <span class='addition' title='".$model->sw_region_rel->bezeichnung."'>".$model->sw_region_rel->kurz ."</span>"; } else { $region = ""; }
        $additions = $herkunft . $grammatik . $fachgebiet . $gebrauch . $region;

        if ($model->noun_class != "") { $class = " <span class='noun_class'><a href='".Yii::app()->baseUrl."/index.php/site/page/view/classes'>" . $model->noun_class . "</a></span>"; } else { $class = ""; }
	if ($model->wortart_id != "") { $wortart = " <span style='color:#6A9ACD;font-weight:bold'>" .$model->wortart_rel->bezeichnung. "</span>"; }  else { $wortart = ""; }

	if ($model->anmerkung=="") { $anmerkung = ""; } else { $anmerkung = "<br />" .$model->anmerkung. "<br />"; }

?>
  <tr class="<?php echo $n%2?'even':'odd';?>">
    <td class="col_details">
        <div id="details"><a href="<?php echo(Yii::app()->baseUrl)?>/index.php/wortschatz/viewDetails/id/<?php echo $model->id ?>"><img src="<?php echo(Yii::app()->baseUrl)?>/images/information.png" alt="" /></a></div>
	</td>
	<td><b><?php echo wortschatz::model()->makesearchLink($model->kiswahili) ?></b><?php echo $plural.$additions.$class.$wortart; ?></td>
	<td><?php echo wortschatz::model()->makeSearchLink(CHtml::encode($model->deutsch)); ?></td>
        <td class="resultsAnmerkung"><?php echo CHtml::encode($model->anmerkung); ?></td>
  </tr>
<?php endforeach; ?>
<?php } //endif ?>


  </tbody>
</table>
<?php } //endif ?>

<?php $cssPath = Yii::app()->baseUrl . '/css/customPager.css'; ?>
<?php $pager = $this->widget('CLinkPager',array('pages'=>$pages,'header'=>false,'firstPageLabel'=>'Anfang','prevPageLabel'=>'< zurück','nextPageLabel'=>'weiter >','lastPageLabel'=>'Ende','cssFile'=>$cssPath)); ?>


<br/><br/>
<div class='statistics'>
    <?php if ($pager->pageCount > 10) { echo 'Anzahl Seiten: '. $pager->pageCount; } ?>
</div>

<!--
<?php
        $similarWords = wortschatz::model()->findSimilar($query);
        if (count($similarWords['models_kiswahili']) != 0) {
?>
        <table class="resultTable">
          <thead>
          <tr>
                <th class='resultsSwahili'>Orthographisch �hnliche W�rter - Kiswahili</th>
                <th class='resultsDeutsch'>Orthographisch �hnliche W�rter - Deutsch</th>
          </tr>
          </thead>
          <tbody>
               <tr>
                   <td>

        <?php foreach($similarWords['models_kiswahili'] as $n=>$model): ?>
             
                  <?php echo wortschatz::model()->makeSearchLink(CHtml::encode($model->kiswahili)) . " "; ?>
                  
              
        <?php endforeach; ?>
                   </td>
                   <td></td>
               </tr>

          </tbody>
        </table>
<?php
        } //endif

?>
-->