<?php

use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\grid\ActionColumn;
use app\components\MobileDetect;

if (isset($_GET['page'])) {
    $strPage = ($_GET['page'] > 1) ?  Yii::t('app', 'Page ') . $_GET['page'] : '';
} else {
    $strPage = '';
}


$this->title = $benchName . ' ' . Yii::t('app', 'CPU performance rating')  . ' ' . '| cpu-compare' . ' ' . $strPage;
$this->registerMetaTag(['name' => 'description', 'content' => $benchName . ' ' . Yii::t('app', 'CPU performance rating')  . '. ' . Yii::t('app', 'Choose the best CPU according to the test results') . ' ' . $strPage]);
//$this->registerLinkTag(['rel' => 'canonical', 'href' => Url::canonical()]); 
?>


<div class="container">
    <?php
    $mobileDetect = new MobileDetect();
    if ($mobileDetect->isMobile()) {
        echo '<div class="block-ads" style="padding: 20px 0 20px 0;"><ins class="adsbygoogle"
            style="display:block"
            data-ad-client="ca-pub-7958472158675518"
            data-ad-slot="7243248666"
            data-ad-format="auto"
            data-full-width-responsive="true"></ins>
        <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
        </script></div>
            ';
    } else {
        echo '<div style="margin-top:20px;text-align: center;"><ins class="adsbygoogle"
                    style="display:inline-block;width:336px;height:280px"
                    data-ad-client="ca-pub-7958472158675518"
                    data-ad-slot="1653388322"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
                <ins class="adsbygoogle"
                    style="display:inline-block;width:336px;height:280px"
                    data-ad-client="ca-pub-7958472158675518"
                    data-ad-slot="1270244944"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
                <ins class="adsbygoogle"
                    style="display:inline-block;width:336px;height:280px"
                    data-ad-client="ca-pub-7958472158675518"
                    data-ad-slot="3812647805"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script></div>
            ';
    }
    ?>
    <div class="block">
        <h1 style="font-size: 1.8rem;"><?= Yii::t('app', 'Overall processor performance ranking') ?></h1>
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
                            return '<img src="' . $data->cpu->image . '" style="width: 35px;">';
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
                    'label' => Yii::t('app', 'place'),
                    'value'  => function ($data) {
                        return $data->position;
                    }
                ],

                [
                    'label' => Yii::t('app', 'Mobile'),
                    'value' => function ($data) {
                        if ($data->mobile) {
                            if ($data->mobile == 1)
                                return 'Yes';
                        } else {
                            return 'No';
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
                                    Url::to(['cpu/index', 'alias' => $data->cpu->alias]),
                                    [
                                        'title' => Yii::t('app', 'Compare'),
                                        'target' => '_blank',
                                        'class' => 'btn btn-yellow',
                                        'style' => 'width: fit-content;',
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