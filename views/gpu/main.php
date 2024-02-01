<?php

use yii\widgets\Breadcrumbs;
use app\components\MobileDetect;

/* @var $this yii\web\View */

$this->title = Yii::t('app', 'GPU Online Comparison Tool, Specs and performans Graphics cards in bench');
$this->registerMetaTag(['name' => 'description', 'content' => Yii::t('app', 'Online Graphics cards comparison service by characteristics and performance in benchmarks. Tests Nvidia, AMD, mobile GPUs')]);

$this->params['breadcrumbs'][] = array(
    'label' => Yii::t('app', 'Home'),
    'url' => Yii::$app->homeUrl,
);

$this->params['breadcrumbs'][] = array(
    'label' => Yii::t('app', 'GPU comparison'),
);
?>

<div class="container">
    <?php
    echo Breadcrumbs::widget([
        'itemTemplate' => "<li>{link}</li> &nbsp/&nbsp \n",
        'options' => ['class' => 'breadcrumb', 'style' => 'justify-content: center;font-size: 0.9em;background-color:inherit;font-weight: 500;'],
        'homeLink' => false,
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]); ?>
    <h1 class="big-compare-name" style="font-size:22px;"><?= Yii::t('app', 'Comparing graphics cards on specs and performance') ?></h1>
    <div class="text" style="text-align: center;"><?= Yii::t('app', 'Main specifications, results of popular benchmarks, performance rating and reviews') . '. ' . Yii::t('app', 'More') . ' ' . $count . ' ' . Yii::t('app', 'Graphics Cards models.') ?></div>
    <?php
    $mobileDetect = new MobileDetect();
    if ($mobileDetect->isMobile()) {
        echo '<ins class="adsbygoogle"
            style="display:block"
            data-ad-client="ca-pub-7958472158675518"
            data-ad-slot="8754257999"
            data-ad-format="auto"
            data-full-width-responsive="true"></ins>
        <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
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
    <?= app\components\LatestCompareWidget::widget(['category' => '2']) ?>

    <div class="row">
        <div class="col-xl-9">
            <div class="row">
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
                                            <span><?= $width ?>%</span>
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
                                            <span><?= $width ?>%</span>
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
                                            <span><?= $width ?>%</span>
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
                    <?php if (count($gpu->latests)) : ?>
                        <div class="box">
                            <div class="box-title">
                                <?= Yii::t('app', 'Novelties') ?>
                            </div>
                            <div class="box-subtitle">
                                <?= Yii::t('app', 'New graphics cards') ?>
                            </div>
                            <div class="box-body">
                                <?php foreach ($gpu->latests as $key => $card) : ?>
                                    <div class="progress my-progres <?= $key < 3 ? 'orange' : '' ?>">
                                        <div class="progress-bar" role="progressbar" style="width: <?= $gpu_width ?>%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="95">
                                            <div>
                                                <span><a style="color: #fff;" href="<?= Yii::$app->urlManager->createUrl(['cpu/index', 'alias' => $card->alias]) ?>"><span><?= $card->name ?></a></span>
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
                <div class="col-md-6">
                    <div class="title">
                        <img src="/images/icons/cpu-orange.svg" alt="gpu">
                        <?= Yii::t('app', 'GPU benchmarks') ?>
                    </div>

                    <?php if (count($gpu->nvidia)) : ?>
                        <div class="box">
                            <div class="box-title">
                                <?= Yii::t('app', 'Nvidia best GPU') ?>
                            </div>
                            <div class="box-subtitle">
                                <?= Yii::t('app', 'Nvidia GPU benchmark') ?>
                            </div>
                            <div class="box-body">
                                <?php $width = 100; ?>
                                <?php foreach ($gpu->nvidia as $key => $card) : ?>
                                    <div class="progress my-progres <?= $key < 3 ? 'orange' : '' ?>">
                                        <div class="progress-bar" role="progressbar" style="width: <?= $width ?>%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="95">
                                            <div>
                                                <span><a style="color: #fff;" href="<?= Yii::$app->urlManager->createUrl(['gpu/index', 'alias' => $card->alias]) ?>"><span><?= $card->name ?></a></span>
                                            </div>
                                            <span><?= $width ?>%</span>
                                        </div>
                                    </div>
                                    <?php $width--; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if (count($gpu->amd)) : ?>
                        <div class="box">
                            <div class="box-title">
                                <?= Yii::t('app', 'AMD best GPU') ?>
                            </div>
                            <div class="box-subtitle">
                                <?= Yii::t('app', 'AMD GPU benchmark') ?>
                            </div>
                            <div class="box-body">
                                <?php $width = 100; ?>
                                <?php foreach ($gpu->amd as $key => $card) : ?>
                                    <div class="progress my-progres <?= $key < 3 ? 'orange' : '' ?>">
                                        <div class="progress-bar" role="progressbar" style="width: <?= $width ?>%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="95">
                                            <div>
                                                <span><a style="color: #fff;" href="<?= Yii::$app->urlManager->createUrl(['gpu/index', 'alias' => $card->alias]) ?>"><?= $card->name ?></a></span>
                                            </div>
                                            <span><?= $width ?>%</span>
                                        </div>
                                    </div>
                                    <?php $width--; ?>
                                <?php endforeach; ?>

                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if (count($gpu->ethereum)) : ?>
                        <div class="box">
                            <div class="box-title">
                                <?= Yii::t('app', 'Ethereum best GPU') ?>
                            </div>
                            <div class="box-subtitle">
                                <?= Yii::t('app', 'Ethereum GPU benchmark') ?>
                            </div>
                            <div class="box-body">
                                <?php $width = 100; ?>
                                <?php foreach ($gpu->ethereum as $key => $card) : ?>
                                    <div class="progress my-progres <?= $key < 3 ? 'orange' : '' ?>">
                                        <div class="progress-bar" role="progressbar" style="width: <?= $width ?>%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="95">
                                            <div>
                                                <span><a style="color: #fff;" href="<?= Yii::$app->urlManager->createUrl(['gpu/index', 'alias' => $card->alias]) ?>"><?= $card->name ?></a></span>
                                            </div>
                                            <span><?= $width ?>%</span>
                                        </div>
                                    </div>
                                    <?php $width--; ?>
                                <?php endforeach; ?>

                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if (count($gpu->ergo)) : ?>
                        <div class="box">
                            <div class="box-title">
                                <?= Yii::t('app', 'Ergo best GPU') ?>
                            </div>
                            <div class="box-subtitle">
                                <?= Yii::t('app', 'Ergo GPU benchmark') ?>
                            </div>
                            <div class="box-body">
                                <?php $width = 100; ?>
                                <?php foreach ($gpu->ergo as $key => $card) : ?>
                                    <div class="progress my-progres <?= $key < 3 ? 'orange' : '' ?>">
                                        <div class="progress-bar" role="progressbar" style="width: <?= $width ?>%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="95">
                                            <div>
                                                <span><a style="color: #fff;" href="<?= Yii::$app->urlManager->createUrl(['gpu/index', 'alias' => $card->alias]) ?>"><?= $card->name ?></a></span>
                                            </div>
                                            <span><?= $width ?>%</span>
                                        </div>
                                    </div>
                                    <?php $width--; ?>
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
                                    <?php $gpu_width -= 2; ?>
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
        echo '<ins class="adsbygoogle"
            style="display:block"
            data-ad-client="ca-pub-7958472158675518"
            data-ad-slot="8395165342"
            data-ad-format="auto"
            data-full-width-responsive="true"></ins>
        <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
            ';
    } else {
        echo '<div style="margin-top:20px;text-align: center;"><ins class="adsbygoogle"
            style=" text-align:center; width: 336px; height: 280px; display: inline-block;"
                data-full-width-responsive="true"
                data-ad-client="ca-pub-7958472158675518"
                data-ad-slot="7749680978"></ins>
            <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
            <ins class="adsbygoogle"
            style=" text-align:center; width: 336px; height: 280px; display: inline-block;"
                data-full-width-responsive="true"
                data-ad-client="ca-pub-7958472158675518"
                data-ad-slot="6128094654"></ins>
            <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
            </div>
        ';
    }
    ?>
    <!-- latest compare -->
    <?= app\components\PopularCompareGpuWidget::widget() ?>

    <!-- reviews -->
    <?= app\components\ReviewsGpuWidget::widget() ?>
    <?php
    if ($mobileDetect->isMobile()) {
        echo '<ins class="adsbygoogle"
        style="display:block"
        data-ad-client="ca-pub-7958472158675518"
        data-ad-slot="3118787932"
        data-ad-format="auto"
        data-full-width-responsive="true"></ins>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
            ';
    } else {
        echo '<div style="margin-top:20px;text-align: center;"><ins class="adsbygoogle"
        style=" text-align:center; width: 336px; height: 280px; display: inline-block;"
            data-full-width-responsive="true"
            data-ad-client="ca-pub-7958472158675518"
            data-ad-slot="2188849649"></ins>
        <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
        <ins class="adsbygoogle"
        style=" text-align:center; width: 336px; height: 280px; display: inline-block;"
            data-full-width-responsive="true"
            data-ad-client="ca-pub-7958472158675518"
            data-ad-slot="7082083676"></ins>
        <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
        </div>
        ';
    }
    ?>
    <!-- about -->
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