<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Card */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Процессоры', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
?>
<div class="card">
    <div class="card-body">
        <?= $this->render('_form', [
            'model' => $model,
            'brands' => $brands,
            'specifications' => $specifications,
            'benchmarks' => $benchmarks,
        ]) ?>

    </div>
</div>
