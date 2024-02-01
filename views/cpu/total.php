<?php

use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\grid\ActionColumn;
use app\models\Phone;

if (isset($_GET['page'])) {
    $strPage = ($_GET['page'] > 1) ?  Yii::t('app', 'Page ') . $_GET['page'] : '';
} else {
    $strPage = '';
}


$this->title = $benchName . ' ' . Yii::t('app', 'CPU performance rating | cpu-compare')  . ' ' . $strPage;
$this->registerMetaTag(['name' => 'description', 'content' => $benchName . ' ' . Yii::t('app', 'CPU performance rating')  . '. ' . Yii::t('app', 'Choose the best CPU according to the test results') . ' ' . $strPage]);

?>


<div class="container">

    <div class="block">
        <h1 style="font-size: 1.8rem;"><?= $benchName . ' ' . Yii::t('app', 'Processor performance rating') ?></h1>
        <p><?= Yii::t('app', 'The overall rating of the Cpu-compare site. Calculated based on other benchmarks.') ?></p>
        <?php Pjax::begin(['id' => 'grid-pjax']); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'tableOptions' => [
                'class' => 'table table-striped table-hover table-sm'
            ],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'label' => Yii::t('app', 'Photo'),
                    'format' => 'raw',
                    'value' => function ($data) {
                        if (isset($data->cpu->image)) {
                            return '<img src="' . Yii::getAlias('@img_url') . '/thumbs/' . $data->cpu->image . '">';
                        } else {
                            return 'No foto';
                        }
                    },
                ],

                [
                    'attribute' => 'cpu_id',
                    'label' => Yii::t('app', 'Name'),
                    'format' => 'raw',
                    'value' => function ($data) {
                        if (isset($data->cpu->name)) {
                            return $data->cpu->name;
                        } else {
                            return 'No data';
                        }
                    }
                ],
                [
                    'attribute' => 'position',
                    'label' => Yii::t('app', 'Position'),
                    'value'  => function ($data) {
                        return $data->position;
                    }
                ],

                [
                    'label' => Yii::t('app', 'Mobile'),
                    'value' => function ($data) {
                        if ($data->mobile) {
                            return $data->mobile;
                        } else {
                            return '';
                        }
                    }
                ],

                [
                    'label' => Yii::t('app', 'Compare'),
                    'format' => 'raw',
                    'value' => function ($data) {
                        if ($data->cpu) {
                            return '<div class="t6"><div class="rating-table-name">Compare</div>' .
                                Html::a(
                                    Yii::t('app', 'Compare'),
                                    Url::to(['cpu/index', 'url' => $data->cpu->url]),
                                    [
                                        'title' => Yii::t('app', 'Compare'),
                                        'target' => '_blank',
                                        'class' => 'btn btn-yellow',
                                        'style' => 'width: fit-content',
                                    ]
                                ) . '</div></div>';
                        } else {
                            return '';
                        }
                    }
                ],
            ],
        ]);
        ?>
        <?php Pjax::end(); ?>

    </div>


</div>