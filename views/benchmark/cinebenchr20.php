<?php

use yii\helpers\Url;
use yii\widgets\LinkPager;
use app\models\Card;
use app\components\MobileDetect;

if (isset($_GET['page'])) {
    $strPage = ($_GET['page'] > 1) ?  Yii::t('app', 'Page ') . $_GET['page'] : '';
} else {
    $strPage = '';
}

$this->title = Yii::t('app', 'Cinebench R20 processor performance rankings, specifications CPU and scores') . ' ' . $strPage;
$this->registerMetaTag(['name' => 'description', 'content' => Yii::t('app', "Cinebench R20 is a high load CPU test for long tasks on a desktop or notebook PC, using a multi-core and hyperthreading. Unleashes the processor's potential to handle demanding 3D tasks.") . ' ' . $strPage]);

$p = 1;
if (isset($_GET['page']) && $_GET['page'] != 1)
    $p = ($_GET['page'] - 1) * 20 + 1;
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
                </div>
            ';
    }
    ?>
    <div class="block">
        <div class="title mb-30">
            <h1 class="big-compare-name" style="margin-top:15px;margin-bottom:25px;"><?= Yii::t('app', $title) ?></h1>
        </div>
        <p><?= Yii::t('app', "Cinebench R20 is a high load CPU test for long tasks on a desktop or notebook PC, using a multi-core and hyperthreading. Unleashes the processor's potential to handle demanding 3D tasks. The benchmark is based on Cinema 4D 20 Suite.") ?></p>
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
                            <div class="rating-table-name">Multi-Core</div>
                        </div>
                        <div class="t3">
                            <div class="rating-table-name">Single-Core</div>
                        </div>
                        <div class="t3">
                            <div class="rating-table-name">Cores</div>
                        </div>
                        <div class="t5">
                            <div class="rating-table-name">Hertz</div>
                        </div>
                        <div class="t6">
                            <div class="rating-table-name">TDP (PL1)</div>
                        </div>
                        <div class="t8">
                            <div class="rating-table-name">Release date</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="rating-table-body">

                <?php foreach ($benchmarksMulti as $bench) : ?>
                    <?php $card = Card::find()->where(['id' => $bench->cpu_id])->one(); ?>
                    <?php if (!$card) continue; ?>
                    <div class="rating-table-item">
                        <div class="rating-table-number">
                            <div class="rating-table-name">№</div>
                            <?= $p ?>
                        </div>
                        <div class="rating-table-content">
                            <div class="t1">
                                <div class="rating-table-name">Processor</div>
                                <div class="t1-flex">
                                    <img src="" alt="">
                                    <a href="<?= Yii::$app->urlManager->createUrl(['cpu/index', 'alias' => $card->alias]) ?>" target="_blank"><span><?= $card->name ?></span></a>
                                </div>
                            </div>
                            <div class="t2">
                                <div class="rating-table-name">Score1</div>
                                <?= $bench->score ?>
                            </div>
                            <div class="t3">
                                <div class="rating-table-name">Score2</div>
                                <?= isset($benchmarksSingle[$bench->cpu_id]) ? $benchmarksSingle[$bench->cpu_id] : '-' ?>
                            </div>
                            <div class="t3">
                                <div class="rating-table-name">Cores</div>
                                <?= ($card)  ? $card->cores : '-' ?>
                            </div>
                            <div class="t5">
                                <div class="rating-table-name">Hertz</div>
                                <?= ($card)  ? $card->hertz : '-'  ?>
                            </div>
                            <div class="t6">
                                <div class="rating-table-name">TDP (PL1)</div>
                                <?= ($card)  ? $card->watt : '-'  ?>
                            </div>
                            <div class="t8">
                                <div class="rating-table-name">Release date</div>
                                <span><?= ($card)  ? $card->release_date : '-'   ?></span>
                            </div>
                        </div>
                    </div>
                    <?php $p++ ?>
                <?php endforeach; ?>
            </div>
        </div>
        <br>
        <br>

        <div class="d-flex justify-content-center">
            <?php echo LinkPager::widget([
                'pagination' => $pages,
                'maxButtonCount'=>6,
            ]);  ?>
        </div>

    </div>

    <?php
    if ($mobileDetect->isMobile()) {
        echo '<div class="block-ads" style="padding: 20px 0 20px 0;"><ins class="adsbygoogle"
        style="display:block"
        data-ad-client="ca-pub-7958472158675518"
        data-ad-slot="2060857130"
        data-ad-format="auto"
        data-full-width-responsive="true"></ins>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
    </script></div>
            ';
    } else {
        echo '<div class="block-ads" style="padding: 20px 0 20px 0;text-align: center;"><ins class="adsbygoogle"
        style=" text-align:center; width: 336px; height: 280px; display: inline-block;"
            data-full-width-responsive="true"
            data-ad-client="ca-pub-7958472158675518"
            data-ad-slot="4617085323"></ins>
        <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
        <ins class="adsbygoogle"
        style=" text-align:center; width: 336px; height: 280px; display: inline-block;"
            data-full-width-responsive="true"
            data-ad-client="ca-pub-7958472158675518"
            data-ad-slot="4301390552"></ins>
        <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
        <ins class="adsbygoogle"
        style=" text-align:center; width: 336px; height: 280px; display: inline-block;"
            data-full-width-responsive="true"
            data-ad-client="ca-pub-7958472158675518"
        data-ad-slot="3304003652"></ins>
        <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
        </script></div>
            ';
    }
    ?>
    <?= app\components\LatestCompareWidget::widget() ?>

</div>