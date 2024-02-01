<?php

use yii\helpers\Url;
use yii\widgets\LinkPager;

$model = new \app\models\Card();
if(isset ($_GET['page'])) {
    $strPage = ($_GET['page'] > 1) ?  Yii::t('app', 'Page ') . $_GET['page'] : '';    
} else {
    $strPage = '';
}

$this->title = $model->listmeta['title'] . ' '. $strPage;

$this->registerMetaTag(['name' => 'description', 'content' => $model->listmeta['description'] . ' '. $strPage]);

$p = 0;
if (isset($_GET['page']) && $_GET['page'] != 1)
    $p = ($_GET['page'] - 1) * 20;
?>


<div class="container">

    <div class="block">
        <div class="title mb-30"> <?= $title ?> </div>

        <div class="rating-table">
            <div class="rating-table-header">
                <div class="rating-table-item">
                    <div class="rating-table-number">
                        <div class="rating-table-name">№</div>
                    </div>
                    <div class="rating-table-content">
                        <div class="t1">
                            <div class="rating-table-name">Processor</div>
                        </div>
                        <div class="t2">
                            <div class="rating-table-name">Type</div>
                        </div>
                        <div class="t3">
                            <div class="rating-table-name">Socket </div>
                        </div>
                        <div class="t4">
                            <div class="rating-table-name">Frequency</div>
                        </div>
                        <div class="t5">
                            <div class="rating-table-name">Cores</div>
                        </div>
                        <div class="t6">
                            <div class="rating-table-name">TDP (PL1)</div>
                        </div>
                        <div class="t7">
                            <div class="rating-table-name">Turbo </span>
                            </div>
                        </div>
                        <div class="t8">
                            <div class="rating-table-name">Release date</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="rating-table-body">
                <?php foreach ($cards as $key => $card) : ?>
                    <div class="rating-table-item">
                        <div class="rating-table-number">
                            <div class="rating-table-name">№</div>
                            <?= ($key + 1) + $p ?>
                        </div>
                        <div class="rating-table-content">
                            <div class="t1">
                                <div class="rating-table-name">Processor</div>
                                <div class="t1-flex">
                                    <img src="<?= $card->image_mini ?>" alt="<?= $card->name ?>">
                                    <a href="<?= Url::to(['cpu/index', 'alias' => $card->alias]) ?>"><span><?= $card->name ?></span></a>
                                </div>
                            </div>
                            <div class="t2">
                                <div class="rating-table-name">Type</div>
                                <?= $card->category ?>
                            </div>
                            <div class="t3">
                                <div class="rating-table-name">Socket</div>
                                <?= trim($card->socket)  ? $card->socket : '-' ?>
                            </div>
                            <div class="t4">
                                <div class="rating-table-name">Frequency</div>
                                <?= trim($card->hertz) ? $card->hertz : '-' ?>
                            </div>
                            <div class="t5">
                                <div class="rating-table-name">Cores</div>
                                <?= trim($card->cores) ? $card->cores : '-' ?>
                            </div>
                            <div class="t6">
                                <div class="rating-table-name">TDP (PL1)</div>
                                <?= trim($card->watt) ? $card->watt : '-' ?>
                            </div>
                            <div class="t7">
                                <div class="rating-table-name">Turbo </div>
                                <?= trim($card->turbo_hertz) ? $card->turbo_hertz : '-' ?>
                            </div>
                            <div class="t8">
                                <div class="rating-table-name">Release date</div>
                                <span><?= trim($card->release_date) ? $card->release_date : '-' ?></span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <br>
        <br>

        <div class="d-flex justify-content-center">
            <?php echo LinkPager::widget([
                'pagination' => $pages,
            ]);  ?>
        </div>

    </div>


    <!-- latest compare -->
    <?= app\components\LatestCompareWidget::widget() ?>

</div>