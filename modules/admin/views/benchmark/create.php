<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Benchmark */

$this->title = 'Добавить';
$this->params['breadcrumbs'][] = ['label' => 'Benchmarks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">
    <div class="card-body">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>

    </div>
</div>
