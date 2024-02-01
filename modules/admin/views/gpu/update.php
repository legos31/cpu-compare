<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Gpu */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Видеокарты', 'url' => ['index']];
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
