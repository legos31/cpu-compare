<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Card */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="card-form">

    <?php $form = ActiveForm::begin(); ?>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Данные</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Характеристики</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Benchmark</a>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="row">
                <div class="col-md-6 col-lg-4">
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6 col-lg-4">
                    <?= $form->field($model, 'brand_id')->dropDownList($brands, ['prompt' => 'Выбрать']) ?>
                </div>
                <div class="col-md-6 col-lg-4">
                    <?= $form->field($model, 'file')->fileInput() ?>
                </div>
                <div class="col-md-6 col-lg-4">
                    <?= $form->field($model, 'file_mini')->fileInput() ?>
                </div>
                <div class="col-md-6 col-lg-4">
                    <?= $form->field($model, 'release_date')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6 col-lg-4">
                    <?= $form->field($model, 'hertz')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6 col-lg-4">
                    <?= $form->field($model, 'category')->dropDownList(['desktop' => 'Desktop', 'laptop' => 'Laptop', 'server' => 'Server', 'embedded' => 'Embedded']) ?>
                </div>
                <div class="col-md-6 col-lg-4">
                    <?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6 col-lg-4">
                    <?= $form->field($model, 'socket')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6 col-lg-4">
                    <?= $form->field($model, 'score')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6 col-lg-4">
                    <?= $form->field($model, 'cores')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6 col-lg-4">
                    <?= $form->field($model, 'turbo_hertz')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6 col-lg-4">
                    <?= $form->field($model, 'watt')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6 col-lg-4">
                    <?= $form->field($model, 'source_url')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6 col-lg-4">
                    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6 col-lg-4">
                    <?= $form->field($model, 'pt_dollar')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6 col-lg-4">
                    <?= $form->field($model, 'rating')->textInput() ?>
                </div>
                <div class="col-md-6 col-lg-4">
                    <?= $form->field($model, 'counter')->textInput() ?>
                </div>
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
                    <?= $form->field($model, 'recomend')->dropDownList([0 => 'Нет', 1 => 'Да'])->label('Рекомендуем') ?>
                </div>
                <div class="col-md-6 col-lg-4">
                    <?= $form->field($model, 'popular')->dropDownList([0 => 'Нет', 1 => 'Да']) ?>
                </div>
            </div>
            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <button type="button" class="btn btn-sm btn-primary mb-2 ml-1" id="add-specification">
                Добавить группу
            </button>
            <div id="specification-row">
                <?php foreach ($model->specifications as $k => $specification) : ?>
                    <div class="col-md-12">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="input-group" style="flex-wrap: nowrap">
                                        <?= Html::dropDownList('Specification[' . $k . '][label]', $specification->id, \yii\helpers\ArrayHelper::map($specifications, 'id', 'text'), ['class' => 'form-control form-control-sm select', 'required' => 'required']); ?>
                                        <div class="input-group-append">
                                            <button class="btn btn-danger remove-extra" type="button">
                                                Удалить
                                            </button>
                                        </div>
                                    </div>

                                </div>
                                <hr>

                                <div class="extra-content">
                                    <?php //foreach ($item['items'] as $l => $itm) : 
                                    ?>
                                    <?php foreach ($model->getSpecItems($specification->id) as $l => $itm) : ?>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm" name="Specification[<?= $k ?>][group][<?= $l ?>][label]" value="<?= $itm->name ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm" name="Specification[<?= $k ?>][group][<?= $l ?>][value]" value="<?= trim($itm->value) ? $itm->value : '--' ?>" required>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <button class="btn btn-danger btn-sm btn-block remove-row">
                                                    Удалить
                                                </button>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
            <button type="button" class="btn btn-sm btn-primary mb-2 ml-1" id="add-benchmark">
                Добавить группу
            </button>
            <div id="benchmark-row">
                <?php foreach ($model->benchmarks as $k2 => $benchmark) : ?>
                    <div class="col-md-12">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="input-group" style="flex-wrap: nowrap">
                                        <?= Html::dropDownList('Benchmark[' . $k2 . '][label]', $benchmark->id, \yii\helpers\ArrayHelper::map($benchmarks, 'id', 'text'), ['class' => 'form-control form-control-sm select', 'required' => 'required']); ?>
                                        <div class="input-group-append">
                                            <button class="btn btn-danger remove-extra" type="button">
                                                Удалить
                                            </button>
                                        </div>
                                    </div>

                                </div>
                                <hr>

                                <div class="extra-content">
                                    <?php //foreach ($item['items'] as $l => $itm) : 
                                    ?>
                                    <?php foreach ($model->getBenchmarkItems($benchmark->id) as $l => $itm) : ?>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm" name="Benchmark[<?= $k2 ?>][group][<?= $l ?>][label]" value="<?= $itm->name ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm" name="Benchmark[<?= $k2 ?>][group][<?= $l ?>][value]" value="<?= trim($itm->value) ? $itm->value : '--' ?>" required>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <button class="btn btn-danger btn-sm btn-block remove-row">
                                                    Удалить
                                                </button>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$k = count($model->specifications);
$k2 = count($model->benchmarks);
$specifications = \yii\helpers\Json::encode($specifications);
$benchmarks = \yii\helpers\Json::encode($benchmarks);
$js = <<<JS

let specifications = $specifications;
let benchmarks = $benchmarks;
let k = $k;
let k2 = $k2;
console.log(k2)

    $(document).on('click', '.remove-row', function() {
        $(this).parent().parent().remove();
    });
    $('.remove-extra').click(function(){
        $(this).parent().parent().parent().parent().parent().parent().remove()
    });

    $('#add-benchmark').click(function(){
        let i = 0;
        let col = createElem('div', 'col-md-12');
        let card = createElem('div', 'card mb-4');
            let card_body = createElem('div', 'card-body');
                let fg = createElem('div', 'form-group');
                    let ig = createElem('div', 'input-group', '', {style: 'flex-wrap: nowrap'});
                        let select = createElem('select', 'form-control form-control-sm select', '', {id: 'extra-select2' + k2, name: 'Benchmark['+ k2 +'][label]'});
                            createElemIn(select, 'option', '', '', {value:''});
                        add(ig, select);
                        let append = createElem('div', 'input-group-append');
                            let del = createElem('button', 'btn btn-danger', 'Удалить', {type: 'button'});
                                del.addEventListener('click', function() {
                                    col.remove();
                                });
                                // createElemIn(del, 'i', 'mdi mdi-delete');
                            add(append, del);
                        add(ig, append);
                    add(fg, ig);
                add(card_body, fg);
                createElemIn(card_body, 'hr');
                let item_add = createElem('button', 'btn btn-info btn-sm btn-block mb-4 add-extra-items', 'Добавить характеристику', {type: 'button'});
                    // createElemIn(item_add, 'i', 'mdi mdi-plus');
                let content = createElem('div', 'extra-content');
                add(card_body, content);
                item_add.addEventListener('click', function(){
                        let row = createElem('div', 'row');
                            let column = createElem('div', 'col-md-5');
                                let frg = createElem('div', 'form-group');
                                    createElemIn(frg, 'input', 'form-control form-control-sm', '', {type: 'text', name: 'Benchmark['+ (k2 - 1) +'][group]['+ i +'][label]', placeholder: 'Название', required: 'required'});
                                add(column, frg);
                            add(row, column);
                            
                            let column2 = createElem('div', 'col-md-5');
                                let frg2 = createElem('div', 'form-group');
                                    createElemIn(frg2, 'input', 'form-control form-control-sm', '', {type: 'text', name: 'Benchmark['+ (k2 - 1) +'][group]['+ i +'][value]', placeholder: 'Значение', required: 'required'});
                                add(column2, frg2);
                            add(row, column2);
                                                        
                            let column4 = createElem('div', 'col');
                                let frg4 = createElem('button', 'btn btn-danger btn-sm btn-block remove-row', 'Удалить', {type: 'button'});
                                    // createElemIn(frg4, 'i', 'mdi mdi-delete');
                                    frg4.addEventListener('click', function() {
                                        $(this).parent().parent().remove();
                                    });
                                add(column4, frg4);
                            add(row, column4);
                            
                        add(content, row);
                        i++;
                });
                
                add(card_body, item_add);
            add(card, card_body);
            add(col, card);
        $('#benchmark-row').append(col);
        $('#extra-select2' + k2).select2({
           data: benchmarks 
        });
        k2++;
    });

    $('#add-specification').click(function(){
        let i = 0;
        let col = createElem('div', 'col-md-12');
        let card = createElem('div', 'card mb-4');
            let card_body = createElem('div', 'card-body');
                let fg = createElem('div', 'form-group');
                    let ig = createElem('div', 'input-group', '', {style: 'flex-wrap: nowrap'});
                        let select = createElem('select', 'form-control form-control-sm select', '', {id: 'extra-select' + k, name: 'Specification['+ k +'][label]'});
                            createElemIn(select, 'option', '', '', {value:''});
                        add(ig, select);
                        let append = createElem('div', 'input-group-append');
                            let del = createElem('button', 'btn btn-danger', 'Удалить', {type: 'button'});
                                del.addEventListener('click', function() {
                                    col.remove();
                                });
                                // createElemIn(del, 'i', 'mdi mdi-delete');
                            add(append, del);
                        add(ig, append);
                    add(fg, ig);
                add(card_body, fg);
                createElemIn(card_body, 'hr');
                let item_add = createElem('button', 'btn btn-info btn-sm btn-block mb-4 add-extra-items', 'Добавить характеристику', {type: 'button'});
                    // createElemIn(item_add, 'i', 'mdi mdi-plus');
                let content = createElem('div', 'extra-content');
                add(card_body, content);
                item_add.addEventListener('click', function(){
                        let row = createElem('div', 'row');
                            let column = createElem('div', 'col-md-5');
                                let frg = createElem('div', 'form-group');
                                    createElemIn(frg, 'input', 'form-control form-control-sm', '', {type: 'text', name: 'Specification['+ (k - 1) +'][group]['+ i +'][label]', placeholder: 'Название', required: 'required'});
                                add(column, frg);
                            add(row, column);
                            
                            let column2 = createElem('div', 'col-md-5');
                                let frg2 = createElem('div', 'form-group');
                                    createElemIn(frg2, 'input', 'form-control form-control-sm', '', {type: 'text', name: 'Specification['+ (k - 1) +'][group]['+ i +'][value]', placeholder: 'Значение', required: 'required'});
                                add(column2, frg2);
                            add(row, column2);
                                                        
                            let column4 = createElem('div', 'col');
                                let frg4 = createElem('button', 'btn btn-danger btn-sm btn-block remove-row', 'Удалить', {type: 'button'});
                                    // createElemIn(frg4, 'i', 'mdi mdi-delete');
                                    frg4.addEventListener('click', function() {
                                        $(this).parent().parent().remove();
                                    });
                                add(column4, frg4);
                            add(row, column4);
                            
                        add(content, row);
                        i++;
                });
                
                add(card_body, item_add);
            add(card, card_body);
            add(col, card);
        $('#specification-row').append(col);
        $('#extra-select' + k).select2({
           data: specifications 
        });
        k++;
    });

    $('.select').select2();
JS;
$this->registerJs($js);


?>