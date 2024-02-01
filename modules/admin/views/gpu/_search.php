<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\GpuSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gpu-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'category_id') ?>

    <?= $form->field($model, 'brand_id') ?>

    <?= $form->field($model, 'image') ?>

    <?php // echo $form->field($model, 'image_mini') ?>

    <?php // echo $form->field($model, 'alias') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'date') ?>

    <?php // echo $form->field($model, 'last_update') ?>

    <?php // echo $form->field($model, 'release_date') ?>

    <?php // echo $form->field($model, 'hertz') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'score') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'memory_size') ?>

    <?php // echo $form->field($model, 'memory_type') ?>

    <?php // echo $form->field($model, 'rating') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'source_url') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
