<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Gpu */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Видеокарти', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="card">
    <div class="card-header header-element-inline d-flex align-items-center justify-content-between">
        <h3 class="card-title"></h3>
        <div class="header-elements">
            <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm']) ?>
            <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger btn-sm',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </div>
    </div>
    <div class="card-body">

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'name',
                //                'category_id',
                [
                    'attribute' => 'brand_id',
                    'format' => 'html',
                    'value' => function ($data) {
                        return $data->brand->name ?? '';
                    },
                ],
                //                'image',
                [
                    'attribute' => 'Картинка',
                    'format' => 'html',
                    'value' => function ($data) {
                        return "<img src='" . $data->image . "'/>";
                    }
                ],
                //                'alias',
                'description:ntext',
                'date:date',
                'last_update:date',
                'release_date',
                'hertz',
                'type',
                'score',
                'price',
                'memory_size',
                'memory_type',
                'rating',
                //                'status',
                'source_url:url',
                'counter',
                'top:boolean',
                'best_processor:boolean',
                'best_score:boolean',
                'best_price:boolean',
                'popular:boolean',
            ],
        ]) ?>
        <h3 class="mt-5">Benchmark</h3>
        <div class="row mt-3">
            <?php foreach ($model->benchmarks as $benchmark) : ?>
                <div class="col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-header header-elements-inline">
                            <h6 class="card-title"> <?= strtoupper($benchmark->name) ?> </h6>
                        </div>
                        <div class="card-body">
                            <ul class="media-list">

                                <?php foreach ($model->getBenchmarkItems($benchmark->id) as $specItem) : ?>
                                    <li class="media">
                                        <div class="media-body">
                                            <div class="d-flex justify-content-between">
                                                <span class="font-size-sm"> <?= $specItem->name ?> </span>
                                                <span class="font-size-sm text-muted"> <?= $specItem->value ?> </span>
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <h3 class="mt-5">Характеристики</h3>
        <div class="row mt-3">
            <?php foreach ($model->specifications as $specification) : ?>
                <div class="col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-header header-elements-inline">
                            <h6 class="card-title"> <?= strtoupper($specification->name) ?> </h6>
                        </div>
                        <div class="card-body">
                            <ul class="media-list">

                                <?php foreach ($model->getSpecItems($specification->id) as $specItem) : ?>
                                    <li class="media">
                                        <div class="media-body">
                                            <div class="d-flex justify-content-between">
                                                <span class="font-size-sm"> <?= $specItem->name ?> </span>
                                                <span class="font-size-sm text-muted"> <?= $specItem->value ?> </span>
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>
        </div>


    </div>
</div>