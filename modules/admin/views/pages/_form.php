<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $page app\modules\admin\models\Pages */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pages-form">

    <?php $form = ActiveForm::begin(); ?>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <?php foreach ($languages as $lang): ?>
            <li class="nav-item">
                <a class="nav-link <?= $lang->code == 'ru' ? 'active' : '' ?>" id="<?= $lang->code ?>-tab" data-toggle="tab" href="#<?= $lang->code ?>" role="tab" aria-controls="<?= $lang->code ?>" aria-selected="true"> <?= $lang->name ?> </a>
            </li>
        <?php endforeach; ?>
    </ul>
    <div class="tab-content" id="myTabContent">
        <?php foreach ($languages as $lang): ?>
            <div class="tab-pane fade <?= $lang->code == 'ru' ? 'show active' : '' ?>" id="<?= $lang->code ?>" role="tabpanel" aria-labelledby="<?= $lang->code ?>-tab">
                <div class="form-group field-pagelanguage-title required has-success">
                    <label class="control-label" for="pagelanguage-title">Title</label>
                    <input type="text" required class="form-control" name="meta[<?= $lang->code ?>][title]" value="<?= $meta[$lang->id]['title'] ?>" maxlength="255" aria-required="true">
                </div>
                <div class="form-group field-pagelanguage-description required">
                    <label class="control-label" for="pagelanguage-description">Meta description</label>
                    <textarea required class="form-control" name="meta[<?= $lang->code ?>][description]" aria-required="true"><?= $meta[$lang->id]['description'] ?></textarea>
                </div>
                <div class="form-group field-pagelanguage-card_description">
                    <label class="control-label" for="pagelanguage-card_description">Card description</label>
                    <textarea class="form-control" name="meta[<?= $lang->code ?>][card_description]" aria-required="true"><?= $meta[$lang->id]['card_description'] ?></textarea>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="form-group mt-3">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?php if($page->id == 2): ?>
    <div class="alert alert-primary" role="alert">
        <div> {{name}} - Наименование </div>
        <div> {{release_date}} - Дата релиза </div>
        <div> {{hertz}} - Частота </div>
        <div> {{type}} - Тип оперативки </div>
        <div> {{socket}} - Сокет </div>
        <div> {{cores}} - Количество ядер </div>
        <div> {{watt}} - Тепловой мощности для охлаждение </div>
    </div>
    <?php endif; ?>

    <?php if($page->id == 4): ?>
        <div class="alert alert-primary" role="alert">
            <div> {{name}} - Наименование </div>
            <div> {{release_date}} - Дата релиза </div>
            <div> {{hertz}} - Частота </div>
            <div> {{memory_size}} - Размер памяти </div>
            <div> {{memory_type}} - Тип памяти </div>
            <div> {{watt}} - Тепловой мощности для охлаждение </div>
        </div>
    <?php endif; ?>

    <?php if($page->id == 3): ?>
        <div class="alert alert-primary" role="alert">
            <div> {{card1_name}} - Наименование первого процессора </div>
            <div> {{card2_name}} - Наименование второго процессора</div>
        </div>
    <?php endif; ?>
    <?php if($page->id == 5): ?>
        <div class="alert alert-primary" role="alert">
            <div> {{card1_name}} - Наименование первого видеокарты </div>
            <div> {{card2_name}} - Наименование второго видеокарты</div>
        </div>
    <?php endif; ?>
</div>
