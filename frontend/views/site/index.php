<?php

/* @var $this yii\web\View */

use yii\web\View;

$this->title = 'Offline Freizeit';
$this->registerAssetBundle(yii\web\JqueryAsset::className(), View::POS_HEAD);

$jsonData = json_decode(file_get_contents(Yii::getAlias('@files').'/json/playplaces.json'));
?>
<div class="site-index">
    <h1>Liste aller Spielplätze in Dresden</h1>
    <ul>
    <?php
        foreach($jsonData->features as $feature) {
            echo '<li>';
            echo '<a href="'.\yii\helpers\Url::to(['site/detail', 'id' => $feature->properties->autoid]).'" target="_blank">'.$feature->properties->ort.', '.$feature->properties->spiel.'</a>';
            echo '</li>';
        }
    ?>
    </ul>
</div>
