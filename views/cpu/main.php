<?php

use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use app\components\MobileDetect;

/* @var $this yii\web\View */

$this->title = Yii::t('app', 'CPU online Comparison Tool. Specs and performance processors in bench');
$this->registerMetaTag(['name' => 'description', 'content' => Yii::t('app', 'Online processors comparison service. Technical specifications, performance and benchmarks')]);
?>

<?php

$this->params['breadcrumbs'][] = array(
    'label' => Yii::t('app', 'Home'),
    'url' => Yii::$app->homeUrl,
);

$this->params['breadcrumbs'][] = array(
    'label' => Yii::t('app', 'CPU comparison'),
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
    <h1 class="big-compare-name" style="font-size:22px;"><?= Yii::t('app', 'Comparing processors on specs and performance') ?></h1>
    <div class="text" style="text-align: center;"><?= Yii::t('app', 'Main specifications, results of popular benchmarks, performance rating and reviews') . '. ' . Yii::t('app', 'More') . ' ' . $count . ' ' . Yii::t('app', 'processor models.') ?></div>
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
    <?= app\components\LatestCompareWidget::widget(['category' => '1']) ?>

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
                                                <span><a style="color: #fff;" href="<?= Yii::$app->urlManager->createUrl(['cpu/index', 'alias' => $card->alias]) ?>"><span><?= $card->name ?></a></span>
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
                                                <span><a style="color: #fff;" href="<?= Yii::$app->urlManager->createUrl(['cpu/index', 'alias' => $card->alias]) ?>"><span><?= $card->name ?></a></span>
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
                                                <span><a style="color: #fff;" href="<?= Yii::$app->urlManager->createUrl(['cpu/index', 'alias' => $card->alias]) ?>"><span><?= $card->name ?></a></span>
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
                                                <span><a style="color: #fff;" href="<?= Yii::$app->urlManager->createUrl(['cpu/index', 'alias' => $card->alias]) ?>"><span><?= $card->name ?></a></span>
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
                                                <span><a style="color: #fff;" href="<?= Yii::$app->urlManager->createUrl(['cpu/index', 'alias' => $card->alias]) ?>"><span><?= $card->name ?></a></span>
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
                        <img src="/images/icons/cpu.svg" alt="cpu">
                        <?= Yii::t('app', 'Processors benchmarks') ?>
                    </div>

                    <?php if (count($cpu->geebench5)) : ?>
                        <div class="box">
                            <div class="box-title">
                                <?= Yii::t('app', 'GeekBench5 best processor') ?>
                            </div>
                            <div class="box-subtitle">
                                <?= Yii::t('app', 'Geekbench5 Multi-Core benchmark') ?>
                            </div>
                            <div class="box-body">
                                <?php $width = 100; ?>
                                <?php foreach ($cpu->geebench5 as $key => $card) : ?>
                                    <div class="progress my-progres <?= $key < 3 ? 'yellow' : '' ?>">
                                        <div class="progress-bar" role="progressbar" style="width: <?= $width ?>%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="95">
                                            <div>
                                                <span><a style="color: #fff;" href="<?= Yii::$app->urlManager->createUrl(['cpu/index', 'alias' => $card->alias]) ?>"><span><?= $card->name ?></a></span>
                                            </div>
                                            <span><?= $width ?>%</span>
                                        </div>
                                    </div>
                                    <?php $width--; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if (count($cpu->cinebench23)) : ?>
                        <div class="box">
                            <div class="box-title">
                                <?= Yii::t('app', 'Cinebench R23 best processor') ?>
                            </div>
                            <div class="box-subtitle">
                                <?= Yii::t('app', 'Cinebench R23 Multi-Core benchmark') ?>
                            </div>
                            <div class="box-body">
                                <?php $width = 100; ?>
                                <?php foreach ($cpu->cinebench23 as $key => $card) : ?>
                                    <div class="progress my-progres <?= $key < 3 ? 'yellow' : '' ?>">
                                        <div class="progress-bar" role="progressbar" style="width: <?= $width ?>%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="95">
                                            <div>
                                                <span><a style="color: #fff;" href="<?= Yii::$app->urlManager->createUrl(['cpu/index', 'alias' => $card->alias]) ?>"><?= $card->name ?></a></span>
                                            </div>
                                            <span><?= $width ?>%</span>
                                        </div>
                                    </div>
                                    <?php $width--; ?>
                                <?php endforeach; ?>

                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if (count($cpu->cinebench20)) : ?>
                        <div class="box">
                            <div class="box-title">
                                <?= Yii::t('app', 'Cinebench R20 best processor') ?>
                            </div>
                            <div class="box-subtitle">
                                <?= Yii::t('app', 'Cinebench R20 Multi-Core benchmark') ?>
                            </div>
                            <div class="box-body">
                                <?php $width = 100; ?>
                                <?php foreach ($cpu->cinebench20 as $key => $card) : ?>
                                    <div class="progress my-progres <?= $key < 3 ? 'yellow' : '' ?>">
                                        <div class="progress-bar" role="progressbar" style="width: <?= $width ?>%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="95">
                                            <div>
                                                <span><a style="color: #fff;" href="<?= Yii::$app->urlManager->createUrl(['cpu/index', 'alias' => $card->alias]) ?>"><?= $card->name ?></a></span>
                                            </div>
                                            <span><?= $width ?>%</span>
                                        </div>
                                    </div>
                                    <?php $width--; ?>
                                <?php endforeach; ?>

                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if (count($cpu->cinebench15)) : ?>
                        <div class="box">
                            <div class="box-title">
                                <?= Yii::t('app', 'Cinebench R15 best processor') ?>
                            </div>
                            <div class="box-subtitle">
                                <?= Yii::t('app', 'Cinebench R15 Multi-Core benchmark') ?>
                            </div>
                            <div class="box-body">
                                <?php $width = 100; ?>
                                <?php foreach ($cpu->cinebench15 as $key => $card) : ?>
                                    <div class="progress my-progres <?= $key < 3 ? 'yellow' : '' ?>">
                                        <div class="progress-bar" role="progressbar" style="width: <?= $width ?>%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="95">
                                            <div>
                                                <span><a style="color: #fff;" href="<?= Yii::$app->urlManager->createUrl(['cpu/index', 'alias' => $card->alias]) ?>"><?= $card->name ?></a></span>
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
                    <?php if (count($cpu->latests)) : ?>
                        <div class="box">
                            <div class="box-title">
                                <?= Yii::t('app', 'Novelties') ?>
                            </div>
                            <div class="box-subtitle">
                                <?= Yii::t('app', 'New processors') ?>
                            </div>
                            <div class="box-body">
                                <?php foreach ($cpu->latests as $key => $card) : ?>
                                    <div class="progress my-progres <?= $key < 3 ? 'yellow' : '' ?>">
                                        <div class="progress-bar" role="progressbar" style="width: <?= $cpu_width ?>%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="95">
                                            <div>
                                                <span><a style="color: #fff;" href="<?= Yii::$app->urlManager->createUrl(['cpu/index', 'alias' => $card->alias]) ?>"><span><?= $card->name ?></a></span>
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
    <!-- popular compare -->
    <?= app\components\PopularCompareCpuWidget::widget() ?>

    <!-- reviews -->
    <?= app\components\ReviewsCpuWidget::widget() ?>

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