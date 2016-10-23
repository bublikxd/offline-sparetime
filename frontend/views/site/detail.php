<?php

/* @var $this yii\web\View */
/* @var $detail */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\FeedbackForm */

use yii\helpers\Html;
use dosamigos\leaflet\types\LatLng;
use dosamigos\leaflet\layers\Marker;

$this->title = 'Detailansicht';
$this->params['breadcrumbs'][] = $this->title;

$district = preg_split('/[\s,]+/', $detail->oa);
$times = explode(", ", $detail->oeffnung);
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
    <h4>Ort: <?= $detail->ort ?></h4>
    <p><strong>Stadtteil:</strong> <?= $district[1] ?></p>
    <p><strong>Spiele:</strong> <?= $detail->spiel ?></p>
    <p><strong>Altersgrenze:</strong> <?= $detail->altersgr ?></p>
    <p><strong>Öffnungszeiten:</strong><br />
        <?php
            foreach($times as $time) {
                echo $time . '<br />';
            }
        ?>
    </p>
    <p><strong>Fläche:</strong> <?= $detail->groesse ?> m2</p>
    <p><strong>Träger:</strong> <?= $detail->traeger ?></p>
    <br />
    <br />
    <h4>Senden Sie uns Ihre Rückmeldung über den Zustand des Spielplatzes!</h4>
    <div class="contact">
        <?php
            echo $this->render('_form', [
                'model' => $model
            ]);
        ?>
    </div>
</div>
