<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $page app\modules\admin\models\Pages */

$this->title = 'Update Page: ' . $page->name;
$this->params['breadcrumbs'][] = ['label' => 'Pages', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $page->name, 'url' => ['view', 'id' => $page->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="card">
    <div class="card-body">

        <?= $this->render('_form', [
            'page' => $page,
            'languages' => $languages,
            'meta' => $meta,
        ]) ?>

    </div>
</div>
