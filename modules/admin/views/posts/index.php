<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\PostsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Статьи';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="card">
    <div class="card-header header-element-inline d-flex align-items-center justify-content-between">
        <h3 class="card-title"></h3>
        <div class="header-elements">
            <?= Html::a('<i class="icon-plus3"></i>', ['create'], ['class' => 'btn btn-success btn-sm']) ?>

        </div>
    </div>
    <div class="card-body">
        <?php Pjax::begin(); ?>
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

//                'id',
                [
                    'label' => 'Изоброжение',
                    'format' => 'html',
                    'value' =>function($data){
                        return '<img src="/'. $data->image .'" height="50" />';
                    }
                ],
                'title',
//                'description:ntext',
//                'date',
                'views',
                //'alias',
                [
                    'attribute' => 'category_id',
                    'format' => 'html',
                    'value' => function ($data) {
                        return $data->categoryName;
                    },
                    'filter' => Html::activeDropDownList($searchModel, 'category_id', \yii\helpers\ArrayHelper::map(\app\modules\admin\models\Category::find()->all(), 'id', 'name'), ['class' => 'form-control select', 'prompt' => ' ']),
                ],
                //'body:ntext',

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
                                'title' => Yii::t('app', 'View'),
                                'class' => 'btn btn-primary btn-sm',
                            ]);
                        },
                        'delete' => function ($url, $model) {
                            return Html::a('<span class="icon-bin2"></span>', $url, [
                                'title' => Yii::t('app', 'View'),
                                'class' => 'btn btn-danger btn-sm',
                                'data' => [
                                    'confirm' => 'Are you sure you want to delete this item?',
                                    'method' => 'post',
                                ],
                            ]);
                        },
                    ],],
            ],
        ]); ?>

        <?php Pjax::end(); ?>
    </div>
</div>

