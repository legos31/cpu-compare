<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Администраторы');
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
        <!--    --><?php // echo $this->render('_search', ['model' => $searchModel]); 
                    ?>


        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                //            'id',
                'username',
                //            'auth_key',
                //            'password',
                //            'password_reset',
                'email:email',
                //            'status' => [
                //                'format' => 'html',
                //                'label' => 'Роль',
                //                'value' => function($data) {
                //                    return \app\modules\admin\models\Users::getRole($data->status);
                //                }
                //
                //            ],
                //'created_at',
                //'updated_at',
                //            'alias',
                //'code',
                //            'img',

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
                    ],
                ],
            ],
        ]); ?>
        <?php Pjax::end(); ?>
    </div>
</div>