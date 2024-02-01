<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\CardSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $brands  */

$this->title = 'Процессоры';
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- <div class="card">

    <div class="card-body">
        <?php // echo $this->render('_search', ['model' => $searchModel]); 
        ?>
    </div>
</div> -->

<div class="card">
    <div class="card-header header-element-inline d-flex align-items-center justify-content-between">
        <h3 class="card-title"></h3>
        <div class="header-elements">
            <?= Html::a('<i class="icon-plus3"></i>', ['create'], ['class' => 'btn btn-success btn-sm']) ?>

        </div>
    </div>
    <div class="card-body">

        <?php Pjax::begin(); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                //            'id',
                //            'image',
                [
                    'attribute' => 'Картинка',
                    'format' => 'html',
                    'value' => function ($data) {
                        return "<img src='" . $data->image_mini . "' height='50px'/>";
                    }
                ],
                'name',
                //            'alias',
                //            'description:ntext',
                //'category_id',
                //'date',
                //'last_update',
                //            'release_date',
                'hertz',
                //'type',
                //'socket',
                //'score',
                'type',
                //'turbo_hertz',
                //'watt',
                //'l3_cache',
                //                'brand_id',
                [
                    'attribute' => 'brand_id',
                    'format' => 'html',
                    'value' => function ($data) {
                        return $data->brand->name ?? '';
                    },
                    'filter'    => $brands
                ],
                [
                    'attribute' => 'category',
                    'filter'    => ["desktop" => "Desktop", "laptop" => "Laptop", "server" => "Server", 'embedded' => 'embedded']
                ],
                [
                    'label' => 'Источник',
                    'format' => 'html',
                    'value' => function ($data) {
                        return "<a href='" . $data->source_url . "' target='_blank'>Ссылка</a>";
                    }
                ],
                //'image_mini',
                //'price',
                //'pt_dollar',
                //'status',
                //'rating',

                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view} {update} {delete}',
                    'contentOptions' => ['style' => 'width:180px;'],
                    'buttons' => [

                        //view button
                        'view' => function ($url, $model) {
                            return Html::a('<span class="icon-eye"></span>', $url, [
                                'title' => Yii::t('app', 'View'),
                                'class' => 'btn btn-success btn-sm',
                            ]);
                        },
                        'update' => function ($url, $model) {
                            return Html::a('<span class="icon-pencil5"></span>', $url, [
                                'title' => Yii::t('app', 'edit'),
                                'class' => 'btn btn-primary btn-sm',
                            ]);
                        },
                        'delete' => function ($url, $model) {
                            return Html::a('<span class="icon-bin2"></span>', $url, [
                                'title' => Yii::t('app', 'delete'),
                                'class' => 'btn btn-danger btn-sm',
                                'data' => [
                                    'confirm' => 'Are you sure you want to delete this item?',
                                    'method' => 'post',
                                ],
                            ]);
                        },
                    ],
                ],
            ],
        ]); ?>

        <?php Pjax::end(); ?>
    </div>
</div>