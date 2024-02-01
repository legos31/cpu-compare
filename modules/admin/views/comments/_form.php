<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Comments */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="comments-form">

    <?php $form = ActiveForm::begin(); ?>

<!--    --><?//= $form->field($model, 'user_id')->textInput() ?>

<!--    --><?//= $form->field($model, 'date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'message')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'like')->textInput() ?>

    <?= $form->field($model, 'dislike')->textInput() ?>

<!--    --><?//= $form->field($model, 'parent_id')->textInput() ?>

<!--    --><?//= $form->field($model, 'blok')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'blok_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
