<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Posts */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Статьи', 'url' => ['index']];
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
                'title',
                [
                    'attribute' => 'image',
                    'format' => 'html',
                    'value' =>function($data){
                        return '<img src="/'. $data->image .'" height="300" />';
                    }
                ],
                'description:html',
                'date:date',
                'views',
                'alias',
                'categoryName',
                'body:raw',
                'meta_desc',
                'meta_key'
            ],
        ]) ?>

    </div>
</div>
