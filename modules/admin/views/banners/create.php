<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Banners */

$this->title = 'Create Banners';
$this->params['breadcrumbs'][] = ['label' => 'Banners', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">
    <div class="card-body">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>

    </div>
</div>