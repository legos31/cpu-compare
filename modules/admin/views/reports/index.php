<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Reports';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">
    <div class="card-body">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

//                'id',
                'text:ntext',
                'link:url',
                'page:url',
//                'new',

                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view} {update} {delete}',
                    'contentOptions' => ['style' => 'width:180px;'],
                    'buttons' => [

                        'delete' => function ($url, $model) {
                            return Html::a('<span class="icon-trash"></span>', $url, [
                                'title' => Yii::t('app', 'delete'),
                                'class' => 'btn btn-danger btn-sm',
                            ]);
                        },
                    ],
                ],
            ],
        ]); ?>

    </div>
</div>
