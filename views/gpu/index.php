<?php

use yii\helpers\Url;
use kartik\rating\StarRating;
use PHPUnit\Util\Log\JSON;
use yii\widgets\ActiveForm;
use app\models\Gpu;
use yii\widgets\Breadcrumbs;
use app\components\MobileDetect; 

// $this->title = $card->meta['title'] ?? '';
// $this->registerMetaTag(['name' => 'description', 'content' => ($card->meta['description'] ?? '')]);

//$specsTDP = $card->oneSpecs('214', 'TDP');

$benchCount = ($benchCount != '') ? '[' . $benchCount . ']' : $benchCount;

$pageTitle = trim(str_replace('{{benchCount}}', $benchCount, $card->meta['title']));
$this->title = $pageTitle ?? '';

$pageDescription = trim(str_replace('{{benchCount}}', count($scoreBench), $card->meta['description']));
$this->registerMetaTag(['name' => 'description', 'content' => ($pageDescription ?? '')]);

$this->params['breadcrumbs'][] = array(
    'label' => Yii::t('app', 'Home'),
    'url' => Yii::$app->homeUrl,
);

$this->params['breadcrumbs'][] = array(
    'label' => Yii::t('app', 'GPU comparison'),
    'url' => Yii::$app->urlManager->createUrl('gpu'),
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
    <?php
    $mobileDetect = new MobileDetect();
    if ($mobileDetect->isMobile()) {
        echo '<!-- мобайл -->
            <ins class="adsbygoogle"
                style="display:block"
                data-ad-client="ca-pub-7958472158675518"
                data-ad-slot="9131045405"
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


    <?php  if ($this->beginCache('gpu-index'.$card->id, 
        ['variations' => [Yii::$app->language]],
        ['duration' => 3600 * 24],
        ['dependency' => [
            'class' => 'yii\caching\DbDependency',
            'sql' => 'SELECT COUNT(*) FROM ratings',
        ]]
        ))
        { ?>

        <div class="big-compare-card mt-30" style="height: auto;">
            <div class="big-compare-top">
                <div class="big-compare-reyting">
                    <span><?= Yii::t('app', 'Overall score') ?></span>
                    <div class="stars">
                        <?php for ($i = 1; $i <= 5; $i++) : ?>
                            <?php if ($i > $card->midRate) : ?>
                                <img src="/images/icons/star.svg" alt="star">
                            <?php else : ?>
                                <img src="/images/icons/star-on.svg" alt="star">
                            <?php endif; ?>
                        <?php endfor; ?>

                    </div>
                </div>
                <div class="big-compare-date text-right">
                    <?= Yii::t('app', 'Released') ?> <br>
                    <?= str_replace('Released', '', $card->release_date) ?>
                </div>
            </div>
            <div class="big-compare-bottom">
                <div class="big-compare-image">
                    <img src="<?= $card->image_logo ?>" alt="<?= $card->name ?>">
                </div>
                <div class="big-compare-name">
                    <h1 class="big-compare-name"><?= Yii::t('app', 'Graphics card') . ' ' . $card->name ?>, <?= Yii::t('app', 'specifications and benchmarks') ?></h1>
                </div>

            </div>
            <?php
            if ($score) { ?>
                <div class="box-title" style="display: block;text-align: center;"><?php if ($score) echo "<span class='rating'>$score</span>" ?> <?= Yii::t('app', 'place in the overall ranking Graphics Cards!') ?></div>
            <?php }
            ?>
            <div class="text">
                <?= $card->meta['card_description'] ?? '' ?>
            </div>
        </div>

        <div class="row mt-30">
            <div class="col-xl-9">

                <div class="content-nav">
                    <a href="#specifications" class="to_scroll"><?= Yii::t('app', 'Specifications') ?></a>
                    <a href="#performance_tests" class="to_scroll"><?= Yii::t('app', 'Benchmarks') ?></a>
                    <a href="#synonyms" class="to_scroll"><?= Yii::t('app', 'Synonyms') ?></a>
                </div>

                <!-- specs -->
                <div class="block" id="specifications">
                    <div class="title mb-30">
                        <h2 style="font-size: 20px;align-items: center;font-weight:700;"><?= Yii::t('app', 'Specifications') ?></h2> <span class="mr-4"></span>
                        <div class="title-sub"><?= Yii::t('app', 'Technical data') ?></div>
                    </div>
                    <?php
                    if ($mobileDetect->isMobile()) {
                        echo '
                    <!-- мобайл -->
                    <ins class="adsbygoogle"
                        style="display:block"
                        data-ad-client="ca-pub-7958472158675518"
                        data-ad-slot="6313310376"
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
                            data-ad-slot="7817963736"></ins>
                        <script>
                            (adsbygoogle = window.adsbygoogle || []).push({});
                        </script>
                        <ins class="adsbygoogle"
                        style=" text-align:center; width: 336px; height: 280px; display: inline-block;"
                            data-full-width-responsive="true"
                            data-ad-client="ca-pub-7958472158675518"
                            data-ad-slot="3878718725"></ins>
                        <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                        </script></div>
                ';
                    }
                    ?>
                    <div class="card-columns mt-30">
                        <?php foreach ($card->specifications as $specifications) : ?>
                            <div class="box mt-0">

                                <?php
                                $descGroup = '';
                                if (isset($specifications->specification->name)) {
                                    $group = $specifications->specification->name;
                                    if ($specifications->specification->name == 'GPU') {
                                        $group = 'General info';
                                        $descGroup = '<p style="font-size:15px;margin-top: 5px;">' . Yii::t('app', 'Key features of the graphics card') . ' ' . $card->name . '.' . '</p>';
                                    } elseif ($specifications->specification->name == 'Connectivity') {
                                        $group = 'Interfaces';
                                        $descGroup = '<p style="font-size:15px;margin-top: 5px;">' . Yii::t('app', 'Connectivity and connections') . '.' . '</p>';
                                    } elseif ($specifications->specification->name == 'Memory') {
                                        $group = 'Memory settings';
                                        $descGroup = '<p style="font-size:15px;margin-top: 5px;">' . Yii::t('app', 'The characteristics of the video memory on board the graphics card') . '. ' . Yii::t('app', 'The higher the better') . '.' . '</p>';
                                    } elseif ($specifications->specification->name == 'Featureset') {
                                        $group = 'Technical data';
                                        $descGroup = '<p style="font-size:15px;margin-top: 5px;">' . Yii::t('app', 'Hardware capabilities and maintaining the API') . '.' . '</p>';
                                    } elseif ($specifications->specification->name == 'Clock Speeds') {
                                        $group = 'Clock frequency';
                                        $descGroup = '<p style="font-size:15px;margin-top: 5px;">' . Yii::t('app', 'Video card clock speed and overclocking potential') . ' ' . $card->name . '.' . '</p>';
                                    } elseif ($specifications->specification->name == 'Supported Video Codecs') {
                                        $descGroup = '<p style="font-size:15px;margin-top: 5px;">' . Yii::t('app', 'Built-in support for video and image compression standards') . '.' . '</p>';
                                    } elseif ($specifications->specification->name == 'Thermal Design') {
                                        $group = 'Thermal Management';
                                        $descGroup = '<p style="font-size:15px;margin-top: 5px;">' . Yii::t('app', 'Connectors, the number of thermal watts emitted in normal mode and at overclocking') . '.' . '</p>';
                                    } elseif ($specifications->specification->name == 'Cooler & Fans') {
                                        $group = 'Cooler & Fans type';
                                        $descGroup = '<p style="font-size:15px;margin-top: 5px;">' . Yii::t('app', 'Cooling system parameters, connectors and fan types') . ' ' . $card->name . '.' . '</p>';
                                    } elseif ($specifications->specification->name == 'Additional data') {
                                        $group = 'More information';
                                    }
                                } else {
                                    $group = 'no data';
                                }
                                
                                ?>
                                <div class="box-title"><?= Yii::t('app', ucfirst($group)) ?></div>
                                <?= $descGroup ?>
                                <ul class="box-list box-list-mini mt-3">
                                    <?php foreach ($specifications->items as $item) : ?>
                                        <?php if ($item->name &&  $item->value) : ?>
                                            <li class="box-list-item">
                                                <div class="f1">
                                                    <?= Yii::t('app', $item->name) ?>
                                                </div>
                                                <div class="f2">
                                                    <strong><?= Yii::t('app', $item->value) ?></strong>
                                                </div>
                                            </li>
                                        <?php endif ?>
                                    <?php endforeach ?>
                                </ul>
                                <?php 
                                    if (isset($specifications->specification->name)) {
                                        if ($specifications->specification->name == 'Clock Speeds') {
                                            echo '* ' . Yii::t('app', 'see below');
                                    } else {
                                        echo 'no data';
                                    }
                                    
                                } ?>
                            </div>
                        <?php endforeach; ?>
                        <div class="box mt-0">
                            <div class="box-title"><?= Yii::t('app', 'Positions in all rankings') ?></div>

                            <p style="font-size:15px;margin-top: 5px;"><?= Yii::t('app', 'Common positions') . ' ' . $card->name . ' ' . Yii::t('app', 'GPU in popular benchmarks, for comparison with other models') . '.' ?></p>
                            <?php if ($scoreBench) : ?>
                                <ul class="box-list box-list-mini mt-3">
                                    <?php foreach ($scoreBench as $key => $score) : ?>
                                        <li class="box-list-item">
                                            <div class="f1">
                                                <?= $key ?>
                                            </div>
                                            <div class="f2">
                                                <strong><?= $score . ' ' . 'place' ?></strong>
                                            </div>
                                        </li>
                                    <?php endforeach ?>
                                </ul>
                            <?php else : ?>
                                <?= Yii::t('app', 'No data') ?>
                            <?php endif ?>

                            <!-- <ul id="resGpuScore" class="box-list box-list-mini mt-3"></ul>
                            <svg class="spinner" viewBox="0 0 50 50" style="display:none">
                                <circle class="path" cx="25" cy="25" r="20" stroke="#e4b74b" fill="none" stroke-width="3"></circle>
                            </svg> -->
                            <!-- <button type="submit" id="GpuScore" class="btn btn-yellow btn-medium" style="margin:auto;">View</button> -->
                        </div>
                    </div>
                </div>
                <!-- specs -->
                <?php
                if ($mobileDetect->isMobile()) {
                    echo '<ins class="adsbygoogle"
                        style="display:block"
                        data-ad-client="ca-pub-7958472158675518"
                        data-ad-slot="4455920334"
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
                        data-ad-slot="5000228702"></ins>
                    <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                    <ins class="adsbygoogle"
                    style=" text-align:center; width: 336px; height: 280px; display: inline-block;"
                        data-full-width-responsive="true"
                        data-ad-client="ca-pub-7958472158675518"
                        data-ad-slot="2374065361"></ins>
                    <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                    </script></div>
                    ';
                }
                ?>
                <!-- Performance tests -->
                <div class="block" id="performance_tests">
                    <div class="title mb-30">
                        <h2 style="font-size: 20px;align-items: center;font-weight:700;"><?= Yii::t('app', 'Benchmarks') ?> </h2><span class="mr-4"></span>
                        <div class="title-sub"><?= Yii::t('app', 'Performance tests') . ' ' ?><?= Yii::t('app', 'GPU') ?></div>
                    </div>
                    <p><?= Yii::t('app', 'Compare the scores of popular benchmarks') . ' ' . $card->name . ' ' . Yii::t('app', 'with other graphics cards to understand the real speed of the GPU when processing content') . '.' ?></p>
                    <p><?= Yii::t('app', 'Tests include working with floating point, creating 3D models, mining cryptocurrencies') . '.' ?></p>
                    <div class="row">
                        <?php foreach ($card->benchmarks as $benchmarks) : ?>
                            <div class="col-md-6">
                                <div class="box mt-0">
                                    <div class="box-title">
                                        <?= Yii::t('app', $benchmarks->benchmark->name) ?>
                                    </div>
                                    <div class="box-subtitle">
                                        <?= Yii::t('app', explode('.', $benchmarks->benchmark->description)[0]) ?>
                                    </div>
                                    <div class="box-body">
                                        <?php
                                        $maxValue = 0;
                                        $valStyle = 0;
                                        $koef = 0;
                                        foreach ($benchmarks->items as $item) {
                                            $currValue = preg_replace('/[^0-9,]/', '', $item->style);
                                            if ($currValue > $maxValue) {
                                                $maxValue = $currValue;
                                            }
                                        }
                                        if ($maxValue < 40) $koef = 40;
                                        ?>

                                        <?php foreach ($benchmarks->items as $item) : ?>
                                            <?php
                                            $val = (int) preg_replace('/[^0-9,]/', '', $item->style);
                                            $val = $val +  $koef;
                                            $item->style = 'width: ' . $val . '%; white-space:nowrap;';
                                            ?>
                                            <div class="progress my-progres <?= $card->name == $item->name ? 'yellow' : '' ?>">
                                                <div class="progress-bar" role="progressbar" style="<?= $item->style ?>" aria-valuenow="80" aria-valuemin="0" aria-valuemax="95">
                                                    <span><?= $item->value ?></span>
                                                </div>
                                            </div>
                                            <div style="font-size: 0.85rem;text-align:center;">
                                                <?php $gpu = Gpu::find()->where(['name' => $item->name])->one(); ?>
                                                <?php if ($gpu) { ?>
                                                    <?php if ($card->name != $item->name) { ?>
                                                        <a href="<?= Yii::$app->urlManager->createUrl(['gpu/index', 'alias' => $gpu->alias]) ?>" target="_blank"><?= $item->name ?></a>
                                                    <?php } else {
                                                        echo $item->name;
                                                    } ?>
                                                <?php } else {
                                                    echo $item->name;
                                                } ?>

                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <div style="font-size: 0.75rem;text-align:center;margin-top: 10px;">
                                        <?php if ($benchmarks->benchmark->url !== null) : ?>
                                            <a href="<?= Url::to(['benchmark/' . $benchmarks->benchmark->url]); ?>" target="_blank"><?= Yii::t('app', 'All the benchmark results') ?></a>
                                        <?php endif ?>

                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                </div>
                <!-- Performance tests -->
                <div class="block" id="synonyms">
                    <?= app\components\SimilarGpuWidget::widget(['card_id' => $card->id]) ?>
                </div>
                <div style="line-height:0.9">
                    <p style="font-size:15px">*</p>
                    <p style="font-size:15px"><?= Yii::t('app', 'Base Clock - this is the guaranteed speed that the manufacturer sets for the type of cooling and binning that the GPU comes out of the factory with.') ?></p>
                    <p style="font-size:15px"><?= Yii::t('app', 'Boost Clock - this is a theoretical minimum speed to which the video card can be overclocked considering the cooling and binning requirements.') ?></p>
                </div>

                <div class="post-rate">
                    <?= Yii::t('app', 'Rate the video card') ?> <br> <?= $card->name ?>
                    <?php
                    $ratingValue = '';
                    if (isset($rating->value)) {
                        $ratingValue = $rating->value;
                    } else {
                        $ratingValue = 0;
                    }
                    echo StarRating::widget([
                        'name' => 'rating_44',
                        'value' => $ratingValue,
                        'pluginOptions' => [
                            'theme' => 'krajee-svg',
                            'filledStar' => '<span class="krajee-icon krajee-icon-star"></span>',
                            'emptyStar' => '<span class="krajee-icon krajee-icon-star"></span>',
                            'step' => 1,
                            'showClear' => false,
                            'showCaption' => false,
                        ]
                    ]);

                    ?>
                </div>

            </div>

            <div class="col-xl-3">
                <?= app\components\CompareWidget::widget(['card_id' => $card->id, 'category' => $card->category_id, 'cur_url' => $card->alias]) ?>
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
        
        <?php $this->endCache();
    }
    ?>

    <!-- latest compare -->
    <?= app\components\LatestCompareWidget::widget(['category' => '2']) ?>

</div>

<?php
$position = Yii::t('app', 'place');

$js = <<<JS

$('.rating-input').change(function(e){
    let val = $(this).val();
    let card_id = $card->id
    
    $.post('/gpu/rating', {card_id: card_id, value: val}, (res) => {
        if(res){
            new Noty({
                type: 'success',
                text: 'Thank you for rating',
                timeout: 3000 
            }).show();
        }else{
            new Noty({
                type: 'error',
                text: 'server error',
                timeout: 3000
            }).show();
        }
    })

})

JS;

$jsScoreGpu = <<<JS

$('#GpuScore').on('click', function(e){
    let spinner = $('.spinner');
    let button = $('[type="submit"]');
    button.css("display", "none");
    spinner.css("display", "block");
    let result = $("#resGpuScore");
    result.html('');
    let card_id = $card->id
    let li = '';
    $.get('/gpu-score/bench', {id: card_id}, (res) => {
        
        if(res){
            
            $.each(res, function(key, value){
                li += '<li class="box-list-item">';
                li += '<div class="f1">';
                li += key;
                li += '</div>';
                li += '<div class="f2"><strong>';
                li += value + ' $position ';
                li += '</strong></div></li>';
            });
			
            spinner.css("display", "none");
            result.append (li);
        }else{
            new Noty({
                type: 'error',
                text: 'server error',
                timeout: 3000
            }).show();
        }

        if(Object.keys(res).length === 0) {
            li = '<li class="box-list-item">';
            li += 'No result found';
            li += '</li>';
            result.append (li);
        }
    })

})

JS;

$this->registerJs($js);
$this->registerJs($jsScoreGpu);

?>

<style>
    .spinner {
        animation: rotate 2s linear infinite;
        z-index: 2;
        position: relative;
        top: 50%;
        left: 50%;
        margin: -25px 0 0 -25px;
        width: 50px;
        height: 50px;
    }

    .path {
        stroke-linecap: round;
        animation: dash 1.5s ease-in-out infinite;
    }

    @keyframes rotate {
        100% {
            transform: rotate(360deg);
        }
    }

    @keyframes dash {
        0% {
            stroke-dasharray: 1, 150;
            stroke-dashoffset: 0;
        }

        50% {
            stroke-dasharray: 90, 150;
            stroke-dashoffset: -35;
        }

        100% {
            stroke-dasharray: 90, 150;
            stroke-dashoffset: -124;
        }
    }
</style>