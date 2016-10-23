<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use dosamigos\leaflet\types\LatLng;
use dosamigos\leaflet\layers\Marker;

$this->title = 'Über das Projekt';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Diese Web-Applikation soll den Bürgern die Suche des Spielplatzes erleichtern.</p>
    <p>Dieses Projekt ist im Rahmen der Open Data Hackaton in Dresden entstanden.</p>
    <br />
    <p>Entwickelt von Gregor Doroschenko gregordoroschenko@yandex.com</p>
</div>
