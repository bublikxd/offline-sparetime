<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use dosamigos\leaflet\types\LatLng;
use dosamigos\leaflet\layers\Marker;
use dosamigos\leaflet\layers\TileLayer;
use dosamigos\leaflet\LeafLet;
use dosamigos\leaflet\widgets\Map;

$this->title = 'Map';
$this->params['breadcrumbs'][] = $this->title;

$center = new LatLng(['lat' => '51', 'lng' => '11']);

$marker = new Marker(['latlng' => $center, 'popupContent' => 'Test! Hey!']);

$tileLayer = new TileLayer([
    'urlTemplate' => 'https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}',
    'clientOptions' => [
        'attribution' => 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://mapbox.com">Mapbox</a>',
        'id' => 'bublikxd.1nippa1l',
        'accessToken' => 'pk.eyJ1IjoiYnVibGlreGQiLCJhIjoiY2l1bGR5N3Y2MDAwbDJ0bzBtMmVrdXg0MCJ9.M6h9Hg6LrCbqYkDsLVWcXg'
    ],
]);

$leaflet = new LeafLet([
    'center' => $center,
]);

$leaflet->addLayer($marker)
        ->addLayer($tileLayer);

?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>This is the About page. You may modify the following file to customize its content:</p>

    <?= Map::widget(['leafLet' => $leaflet]) ?>
</div>
