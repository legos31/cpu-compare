<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Posts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="posts-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'file')->fileInput() ?>

<!--    <div class="form-group">-->
<!--        <label class="control-label" for="customFile">Изорожение</label>-->
<!--        <div class="custom-file">-->
<!--            <input type="file" class="custom-file-input" id="customFile" name="Posts[file]">-->
<!--            <label class="custom-file-label" for="customFile">Выбрать</label>-->
<!--        </div>-->
<!--    </div>-->


<!--    --><?//= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'views')->textInput() ?>

    <?= $form->field($model, 'category_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\modules\admin\models\Category::find()->all(), 'id', 'name'), ['prompt' => '']) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6, 'class' => 'summernote']) ?>

    <?= $form->field($model, 'body')->textarea(['rows' => 6, 'class' => 'summernote']) ?>

    <?= $form->field($model, 'meta_desc')->textarea() ?>
    <?= $form->field($model, 'meta_key')->textarea() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
