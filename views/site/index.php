<?php

use app\components\MobileDetect;

/* @var $this yii\web\View */

$this->title = $page->meta['title'];
$this->registerMetaTag(['name' => 'description', 'content' => $page->meta['description']]);
?>


<?php $mobileDetect = new MobileDetect(); ?>
<div class="container">
    <h1 class="big-compare-name" style="font-size:22px;"><?= Yii::t('app', 'Comparing processors and graphics cards on specs and performance') ?></h1>
    <div class="text" style="text-align: center;"><?= Yii::t('app', 'Main specifications, results of popular benchmarks, performance rating and reviews') ?></div>
    <?php
    if ($mobileDetect->isMobile()) {
        echo '
            <!-- мобайл -->
            <ins class="adsbygoogle"
                style="display:block"
                data-ad-client="ca-pub-7958472158675518"
                data-ad-slot="7243248666"
                data-ad-format="auto"
                data-full-width-responsive="true"></ins>
            <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
            ';
    } else {
        echo '
                <div style="margin-top:20px;text-align: center;"><ins class="adsbygoogle"
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
    <?= app\components\LatestCompareWidget::widget() ?>

    <div class="row">
        <div class="col-xl-9">
            <div class="row">
                <div class="col-md-6">
                    <div class="title">
                        <img src="/images/icons/cpu.svg" alt="cpu">
                        <?= Yii::t('app', 'Processors (Cpu)') ?>
                    </div>

                    <?php if (count($cpu->top10)) : ?>
                        <div class="box">
                            <div class="box-title">
                                <img src="/images/icons/top.svg" alt="top">
                                <?= Yii::t('app', 'Top 10 processors') ?>
                            </div>
                            <div class="box-subtitle">
                                <?= Yii::t('app', 'PassMark CPU Mark') ?>
                            </div>
                            <div class="box-body">
                                <?php $width = 100; ?>
                                <?php foreach ($cpu->top10 as $key => $card) : ?>
                                    <div class="progress my-progres <?= $key < 3 ? 'yellow' : '' ?>">
                                        <div class="progress-bar" role="progressbar" style="width: <?= $width ?>%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="95">
                                            <div>
                                                <a style="color: #fff;" href="<?= Yii::$app->urlManager->createUrl(['cpu/index', 'alias' => $card->alias]) ?>"><span><?= $card->name ?></span></a>
                                            </div>
                                            <span><?= $width ?>%</span>
                                        </div>
                                    </div>
                                    <?php $width--; ?>
                                <?php endforeach; ?>

                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if (count($cpu->bestProcessor)) : ?>
                        <div class="box">
                            <div class="box-title">
                                <?= Yii::t('app', 'Best Integrated Processor') ?>
                            </div>
                            <div class="box-subtitle">
                                <?= Yii::t('app', 'iGPU') ?>
                            </div>
                            <div class="box-body">
                                <?php $width = 100; ?>
                                <?php foreach ($cpu->bestProcessor as $key => $card) : ?>
                                    <div class="progress my-progres <?= $key < 3 ? 'yellow' : '' ?>">
                                        <div class="progress-bar" role="progressbar" style="width: <?= $width ?>%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="95">
                                            <div>
                                                <a style="color: #fff;" href="<?= Yii::$app->urlManager->createUrl(['cpu/index', 'alias' => $card->alias]) ?>"><span><?= $card->name ?></span></a>
                                            </div>
                                            <span><?= $width ?>%</span>
                                        </div>
                                    </div>
                                    <?php $width--; ?>
                                <?php endforeach; ?>

                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if (count($cpu->bestScore)) : ?>
                        <div class="box">
                            <div class="box-title">
                                <?= Yii::t('app', 'Better overall performance') ?>
                            </div>
                            <div class="box-subtitle">
                                <?= Yii::t('app', 'Monero Hashrate kH/s') ?>
                            </div>
                            <div class="box-body">
                                <?php $width = 100; ?>
                                <?php foreach ($cpu->bestScore as $key => $card) : ?>
                                    <div class="progress my-progres <?= $key < 3 ? 'yellow' : '' ?>">
                                        <div class="progress-bar" role="progressbar" style="width: <?= $width ?>%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="95">
                                            <div>
                                                <a style="color: #fff;" href="<?= Yii::$app->urlManager->createUrl(['cpu/index', 'alias' => $card->alias]) ?>"><span><?= $card->name ?></span></a>
                                            </div>
                                            <span><?= $width ?>%</span>
                                        </div>
                                    </div>
                                    <?php $width--; ?>
                                <?php endforeach; ?>

                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if (count($cpu->bestPrice)) : ?>
                        <div class="box">
                            <div class="box-title">
                                <?= Yii::t('app', 'The best processors in terms of price-quality ratio') ?>
                            </div>
                            <div class="box-subtitle">
                                <?= Yii::t('app', 'Fire Strike and CompuBench OpenCL benchmarks') ?>
                            </div>
                            <div class="box-body">
                                <?php $width = 100; ?>
                                <?php foreach ($cpu->bestPrice as $key => $card) : ?>
                                    <div class="progress my-progres <?= $key < 3 ? 'yellow' : '' ?>">
                                        <div class="progress-bar" role="progressbar" style="width: <?= $width ?>%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="95">
                                            <div>
                                                <a style="color: #fff;" href="<?= Yii::$app->urlManager->createUrl(['cpu/index', 'alias' => $card->alias]) ?>"><span><?= $card->name ?></span></a>
                                            </div>
                                            <span><?= $width ?>%</span>
                                        </div>
                                    </div>
                                    <?php $width--; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php $cpu_width = 100; ?>
                    <?php if (count($cpu->populars)) : ?>
                        <div class="box">
                            <div class="box-title">
                                <?= Yii::t('app', 'Popular processors') ?>
                            </div>
                            <div class="box-subtitle">
                                <?= Yii::t('app', 'CPU and iGPU benchmarks') ?>
                            </div>
                            <div class="box-body">
                                <?php foreach ($cpu->populars as $key => $card) : ?>
                                    <div class="progress my-progres <?= $key < 3 ? 'yellow' : '' ?>">
                                        <div class="progress-bar" role="progressbar" style="width: <?= $cpu_width ?>%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="95">
                                            <div>
                                                <a style="color: #fff;" href="<?= Yii::$app->urlManager->createUrl(['cpu/index', 'alias' => $card->alias]) ?>"><span><?= $card->name ?></span></a>
                                            </div>
                                            <span><?= $cpu_width ?>%</span>
                                        </div>
                                    </div>
                                    <?php $cpu_width = $cpu_width - 2; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>


                </div>
                <div class="col-md-6">
                    <div class="title">
                        <img src="/images/icons/cpu-orange.svg" alt="gpu">
                        <?= Yii::t('app', 'Video cards (GPU)') ?>
                    </div>

                    <?php if (count($gpu->top10)) : ?>
                        <div class="box">
                            <div class="box-title">
                                <img src="/images/icons/top.svg" alt="top">
                                <?= Yii::t('app', 'Top 10 video cards') ?>
                            </div>
                            <div class="box-subtitle">
                                <?= Yii::t('app', 'FP32 Performance') ?>
                            </div>
                            <div class="box-body">
                                <?php $width = 100; ?>
                                <?php foreach ($gpu->top10 as $key => $card) : ?>
                                    <div class="progress my-progres <?= $key < 3 ? 'orange' : '' ?>">
                                        <div class="progress-bar" role="progressbar" style="width: <?= $width ?>%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="95">
                                            <div>
                                                <span><a style="color: #fff;" href="<?= Yii::$app->urlManager->createUrl(['gpu/index', 'alias' => $card->alias]) ?>"><?= $card->name ?></a></span>
                                            </div>
                                            <span><?= $width ?></span>
                                        </div>
                                    </div>
                                    <?php $width--; ?>
                                <?php endforeach; ?>

                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if (count($gpu->bestProcessor)) : ?>
                        <div class="box">
                            <div class="box-title">
                                <?= Yii::t('app', 'Best video card') ?>
                            </div>
                            <div class="box-subtitle">
                                <?= Yii::t('app', '3DMark Benchmark') ?>
                            </div>
                            <div class="box-body">
                                <?php $width = 100; ?>
                                <?php foreach ($gpu->bestProcessor as $key => $card) : ?>
                                    <div class="progress my-progres <?= $key < 3 ? 'orange' : '' ?>">
                                        <div class="progress-bar" role="progressbar" style="width: <?= $width ?>%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="95">
                                            <div>
                                                <span><a style="color: #fff;" href="<?= Yii::$app->urlManager->createUrl(['gpu/index', 'alias' => $card->alias]) ?>"><?= $card->name ?></a></span>
                                            </div>
                                            <span><?= $width ?></span>
                                        </div>
                                    </div>
                                    <?php $width--; ?>
                                <?php endforeach; ?>

                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if (count($gpu->bestScore)) : ?>
                        <div class="box">
                            <div class="box-title">
                                <?= Yii::t('app', 'Better overall performance') ?>
                            </div>
                            <div class="box-subtitle">
                                <?= Yii::t('app', 'Battlefield 5') ?>
                            </div>
                            <div class="box-body">
                                <?php $width = 100; ?>
                                <?php foreach ($gpu->bestScore as $key => $card) : ?>
                                    <div class="progress my-progres <?= $key < 3 ? 'orange' : '' ?>">
                                        <div class="progress-bar" role="progressbar" style="width: <?= $width ?>%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="95">
                                            <div>
                                                <span><a style="color: #fff;" href="<?= Yii::$app->urlManager->createUrl(['gpu/index', 'alias' => $card->alias]) ?>"><?= $card->name ?></a></span>
                                            </div>
                                            <span><?= $width ?></span>
                                        </div>
                                    </div>
                                    <?php $width--; ?>
                                <?php endforeach; ?>

                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if (count($gpu->bestPrice)) : ?>
                        <div class="box">
                            <div class="box-title">
                                <?= Yii::t('app', 'The best video cards in terms of price-quality ratio') ?>
                            </div>
                            <div class="box-subtitle">
                                <?= Yii::t('app', 'Fire Strike and CompuBench OpenCL benchmarks') ?>
                            </div>
                            <div class="box-body">
                                <?php foreach ($gpu->bestPrice as $key => $card) : ?>
                                    <div class="progress my-progres <?= $key < 3 ? 'orange' : '' ?>">
                                        <div class="progress-bar" role="progressbar" style="width: <?= $card->score ?>;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="95">
                                            <div>
                                                <span><a style="color: #fff;" href="<?= Yii::$app->urlManager->createUrl(['gpu/index', 'alias' => $card->alias]) ?>"><?= $card->name ?></a></span>
                                            </div>
                                            <span><?= $card->score ?></span>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php $gpu_width = 100; ?>
                    <?php if (count($gpu->populars)) : ?>
                        <div class="box">
                            <div class="box-title">
                                <?= Yii::t('app', 'Popular video cards') ?>
                            </div>
                            <div class="box-subtitle">
                                <?= Yii::t('app', 'CPU and iGPU benchmarks') ?>
                            </div>
                            <div class="box-body">
                                <?php foreach ($gpu->populars as $key => $card) : ?>
                                    <div class="progress my-progres <?= $key < 3 ? 'orange' : '' ?>">
                                        <div class="progress-bar" role="progressbar" style="width: <?= $gpu_width ?>%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="95">
                                            <div>
                                                <span><a style="color: #fff;" href="<?= Yii::$app->urlManager->createUrl(['gpu/index', 'alias' => $card->alias]) ?>"><?= $card->name ?></a></span>
                                            </div>
                                            <span><?= $gpu_width ?>%</span>
                                        </div>
                                    </div>
                                    <?php $gpu_width = $gpu_width - 2; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="col-xl-3">
            <!-- ads -->
            <?php
            if (!$mobileDetect->isMobile()) {
                echo '
                <div class="legos-ads" style="position: -webkit-sticky;position: sticky;top:50px;">
                    <!-- 600 -->
                    <ins class="adsbygoogle"
                        style=" width:300px; min-height: 600px;top: 0;right: 0;bottom: 0;left: 0;margin: auto; display:block"
                        data-ad-client="ca-pub-7958472158675518"
                        data-ad-slot="1763282151"
                        data-ad-format="vertical"
                        data-full-width-responsive="true"></ins>
                    <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>    
                </div>';
            } ?>
        </div>
    </div>

    <?php
    if ($mobileDetect->isMobile()) {
        echo '
                <!-- мобайл -->
                <ins class="adsbygoogle"
                    style="display:block"
                    data-ad-client="ca-pub-7958472158675518"
                    data-ad-slot="2060857130"
                    data-ad-format="auto"
                    data-full-width-responsive="true"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
            ';
    } else {
        echo
        '<ins class="adsbygoogle"
            style=" text-align:center; width: 336px; height: 336px; display: inline-block;"
                data-full-width-responsive="true"
                data-ad-client="ca-pub-7958472158675518"
                data-ad-slot="4617085323"></ins>
            <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
            <ins class="adsbygoogle"
            style=" text-align:center; width: 336px; height: 336px; display: inline-block;"
                data-full-width-responsive="true"
                data-ad-client="ca-pub-7958472158675518"
                data-ad-slot="4301390552"></ins>
            <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
            ';
    }
    ?>

    <?= app\components\PopularCompareWidget::widget() ?>

    <?= app\components\ReviewsWidget::widget() ?>

    <div class="about">
        <div class="title"><?= Yii::t('app', 'About project') ?></div>

        <div class="row">
            <div class="col-md-6">
                <?= Yii::t('app', 'This service uses a conditional system for evaluating the performance of the CPU and GPU. Data on ARM performance processors were taken from a variety of sources, mainly based on the results of such tests, how: PassMark, Antutu, GFXBench.') ?>
            </div>
            <div class="col-md-6">
                <?= Yii::t('app', 'We do not claim absolute accuracy. Rank and measure performance with absolute precision ARM processors impossible, for the simple reason that each of them, in some way has advantages, and in some way lags behind from other ARM processors.') ?>
            </div>
        </div>
    </div>

</div>