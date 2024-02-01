<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\CardSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="card-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-md-6 col-lg-4">
            <?= $form->field($model, 'top')->dropDownList([0 => 'Нет', 1 => 'Да']) ?>
        </div>
        <div class="col-md-6 col-lg-4">
            <?= $form->field($model, 'best_processor')->dropDownList([0 => 'Нет', 1 => 'Да']) ?>
        </div>
        <div class="col-md-6 col-lg-4">
            <?= $form->field($model, 'best_score')->dropDownList([0 => 'Нет', 1 => 'Да']) ?>
        </div>
        <div class="col-md-6 col-lg-4">
            <?= $form->field($model, 'best_price')->dropDownList([0 => 'Нет', 1 => 'Да']) ?>
        </div>
        <div class="col-md-6 col-lg-4">
            <?= $form->field($model, 'popular')->dropDownList([0 => 'Нет', 1 => 'Да']) ?>
        </div>
    </div>

    <?php // echo $form->field($model, 'category_id') 
    ?>

    <?php // echo $form->field($model, 'date') 
    ?>

    <?php // echo $form->field($model, 'last_update') 
    ?>

    <?php // echo $form->field($model, 'release_date') 
    ?>

    <?php // echo $form->field($model, 'hertz') 
    ?>

    <?php // echo $form->field($model, 'type') 
    ?>

    <?php // echo $form->field($model, 'socket') 
    ?>

    <?php // echo $form->field($model, 'score') 
    ?>

    <?php // echo $form->field($model, 'cores') 
    ?>

    <?php // echo $form->field($model, 'turbo_hertz') 
    ?>

    <?php // echo $form->field($model, 'watt') 
    ?>

    <?php // echo $form->field($model, 'l3_cache') 
    ?>

    <?php // echo $form->field($model, 'source_url') 
    ?>

    <?php // echo $form->field($model, 'brand_id') 
    ?>

    <?php // echo $form->field($model, 'image_mini') 
    ?>

    <?php // echo $form->field($model, 'price') 
    ?>

    <?php // echo $form->field($model, 'pt_dollar') 
    ?>

    <?php // echo $form->field($model, 'status') 
    ?>

    <?php // echo $form->field($model, 'category') 
    ?>

    <?php // echo $form->field($model, 'rating') 
    ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>