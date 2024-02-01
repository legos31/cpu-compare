<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Users */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Администраторы'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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

        <div class="row">
            <div class="col-md-4">

                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img style="width: 200px" src="/web/<?= $model->img ?>" class="profile-user-img img-responsive img-circle" alt="<?= $model->username ?>">
                        <br>
                        <?= DetailView::widget([
                            'model' => $model,
                            'attributes' => [
                                'id',
                                'username',
                                'email:email',
                                'status' => [
                                    'format' => 'html',
                                    'label' => 'Роль',
                                    'value' => function ($data) {
                                        return \app\modules\admin\models\Users::getRole($data->status);
                                    }

                                ],
                                'created_at:date',
                                'updated_at:date',
                                'alias',
                            ],
                        ]) ?>
                    </div>
                </div>

            </div>
        </div>



    </div>
</div>