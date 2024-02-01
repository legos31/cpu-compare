<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use app\models\Card;

$this->title = $page->meta['title'];
$this->registerMetaTag(['name' => 'description', 'content' => $page->meta['description']]);
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container mt-5 mb-5">
    
    <h2>About Us | cpu-compare</h2>
    <p>cpu-compare.com - online service for comparing processors and graphics cards by characteristics and benchmarks.</p>

    <p>Our task is to make the selection as simple and understandable as possible.</p>

    <p>We have the largest database of processors and graphics cards!</p>

    <p>Have questions? Let's discuss:</p>

    <p>cpu.compare@gmail.com</p>

</div>