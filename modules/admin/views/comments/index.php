<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\CommentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Коментарии';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">
    <div class="card-header header-element-inline d-flex align-items-center justify-content-between">
        <h3 class="card-title"></h3>
        <div class="header-elements">
<!--            --><?//= Html::a('<i class="icon-plus3"></i>', ['create'], ['class' => 'btn btn-success btn-sm']) ?>

        </div>
    </div>
    <div class="card-body">

        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                [
                    'attribute' => 'user_id',
                    'format' => 'html',
                    'value' => function ($data) {
                        return ($data->user->name ?? '') . ' (' . ($data->user->email ?? '') . ')';
                    },
                    'filter' => Html::activeDropDownList($searchModel, 'user_id', ArrayHelper::map(\app\modules\admin\models\CommentUsers::find()->asArray()->all(), 'id', 'name'), ['class' => 'select', 'prompt' => ' ']),
                ],
                'date:datetime',
                'message:ntext',
//                'like',
//                'dislike',
                //'parent_id',
                [
                    'attribute' => 'blok',
                    'filter' => ['cpu' => 'Cpu', 'cpu_compare' => 'Cpu compare', 'gpu' => 'Gpu', 'gpu_compare' => 'Gpu compare']
                ],
                //'blok_id',

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


    </div>
</div>
