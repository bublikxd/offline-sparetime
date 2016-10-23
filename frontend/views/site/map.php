<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use dosamigos\leaflet\types\LatLng;
use dosamigos\leaflet\layers\Marker;
use dosamigos\leaflet\layers\TileLayer;
use dosamigos\leaflet\LeafLet;
use dosamigos\leaflet\widgets\Map;
use dosamigos\leaflet\layers\GeoJson;
use dosamigos\leaflet\plugins\markercluster\MarkerCluster;
use yii\web\View;

$this->registerAssetBundle(yii\web\JqueryAsset::className(), View::POS_HEAD);

$this->title = 'Karte';
$this->params['breadcrumbs'][] = $this->title;

$center = new LatLng(['lat' => '51.0508900', 'lng' => '13.7383200']);

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

$jsonData = json_decode(file_get_contents(Yii::getAlias('@files').'/json/playplaces.json'));

$all = new \dosamigos\leaflet\layers\LayerGroup();
$getA = new \dosamigos\leaflet\layers\LayerGroup();
$getB = new \dosamigos\leaflet\layers\LayerGroup();
$getC = new \dosamigos\leaflet\layers\LayerGroup();
$getD = new \dosamigos\leaflet\layers\LayerGroup();
$getE = new \dosamigos\leaflet\layers\LayerGroup();

$alter = new \dosamigos\leaflet\layers\LayerGroup();
$alter2 = new \dosamigos\leaflet\layers\LayerGroup();
$spielA = new \dosamigos\leaflet\layers\LayerGroup();
$spielA2 = new \dosamigos\leaflet\layers\LayerGroup();

foreach($jsonData->features as $feature) {

    $popup = 'Ort: ' . $feature->properties->ort .
        '<br />Spiele: ' . $feature->properties->spiel .
        '<br /><a href="'.\yii\helpers\Url::to(['site/detail', 'id' => $feature->properties->autoid]).'" target="_blank">Mehr Info...</a>';
    $district = preg_split('/[\s,]+/', $feature->properties->oa);
    switch($district[1]) {
        case 'Cotta':
            $pos = new LatLng(['lat' => $feature->geometry->coordinates[1], 'lng' => $feature->geometry->coordinates[0]]);
            $newMarkerA = new Marker(['latlng' => $pos, 'popupContent' => $popup]);
            $getA->addLayer($newMarkerA);
            break;
        case 'Prohlis':
            $pos = new LatLng(['lat' => $feature->geometry->coordinates[1], 'lng' => $feature->geometry->coordinates[0]]);
            $newMarkerB = new Marker(['latlng' => $pos, 'popupContent' => $popup]);
            $getB->addLayer($newMarkerB);
            break;
        case 'Neustadt':
            $pos = new LatLng(['lat' => $feature->geometry->coordinates[1], 'lng' => $feature->geometry->coordinates[0]]);
            $newMarkerC = new Marker(['latlng' => $pos, 'popupContent' => $popup]);
            $getC->addLayer($newMarkerC);
            break;
        case 'Pieschen':
            $pos = new LatLng(['lat' => $feature->geometry->coordinates[1], 'lng' => $feature->geometry->coordinates[0]]);
            $newMarkerD = new Marker(['latlng' => $pos, 'popupContent' => $popup]);
            $getD->addLayer($newMarkerD);
            break;
        case 'Altstadt':
            $pos = new LatLng(['lat' => $feature->geometry->coordinates[1], 'lng' => $feature->geometry->coordinates[0]]);
            $newMarkerE = new Marker(['latlng' => $pos, 'popupContent' => $popup]);
            $getE->addLayer($newMarkerE);
            break;
    }
    if($feature->properties->altersgr == "0 bis 6 Jahre") {
        $pos = new LatLng(['lat' => $feature->geometry->coordinates[1], 'lng' => $feature->geometry->coordinates[0]]);
        $newMarkerAlter = new Marker(['latlng' => $pos, 'popupContent' => $popup]);
        $alter->addLayer($newMarkerAlter);
    }
    if($feature->properties->altersgr == "6 bis 12 Jahre") {
        $pos = new LatLng(['lat' => $feature->geometry->coordinates[1], 'lng' => $feature->geometry->coordinates[0]]);
        $newMarkerAlter2 = new Marker(['latlng' => $pos, 'popupContent' => $popup]);
        $alter2->addLayer($newMarkerAlter2);
    }
    $spiel = explode(" ", $feature->properties->spiel);
    if($spiel[0] == "Klettern") {
        $pos = new LatLng(['lat' => $feature->geometry->coordinates[1], 'lng' => $feature->geometry->coordinates[0]]);
        $newMarkerSpiel = new Marker(['latlng' => $pos, 'popupContent' => $popup]);
        $spielA->addLayer($newMarkerSpiel);
    }
    /*
    $getA->addLayer($newMarkerA);
    $getB->addLayer($newMarkerB);
    $getC->addLayer($newMarkerC);
    $getD->addLayer($newMarkerD);
    $getE->addLayer($newMarkerE);*/

    $pos = new LatLng(['lat' => $feature->geometry->coordinates[1], 'lng' => $feature->geometry->coordinates[0]]);
    $newMarker = new Marker(['latlng' => $pos, 'popupContent' => $popup]);
    $all->addLayer($newMarker);

}


$layers = new \dosamigos\leaflet\controls\Layers([
    'overlays' => [
        'Alle' => $all,
        'Cotta' => $getA,
        'Prohlis' => $getB,
        'Neustadt' => $getC,
        'Pieschen' => $getD,
        'Altstadt' => $getE,
        '0 bis 6 Jahre' => $alter,
        '6 bis 12 Jahre' => $alter2,
        'Klettern' => $spielA,
        //'Tischtennis' => $spielA2
    ]
]);

$leaflet->addControl($layers);
$leaflet->addLayer($tileLayer);

?>
<div class="site-about">
    <?= Map::widget([
        'leafLet' => $leaflet,
        'options' => [
            'style' => 'min-height: 600px',
        ]
    ]) ?>
</div>
