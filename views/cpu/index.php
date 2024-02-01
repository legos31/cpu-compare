<?php

use yii\helpers\Url;
use kartik\rating\StarRating;
use PHPUnit\Util\Log\JSON;
use yii\widgets\ActiveForm;
use app\models\Card;
use yii\widgets\Breadcrumbs;
use app\components\MobileDetect;

$benchmarksCount = count($scoreBench);


$pageTitle = trim(str_replace('{{benchCount}}', $benchmarksCount, $card->meta['title']));
$this->title = $pageTitle ?? '';

$pageDescription = trim(str_replace('{{benchCount}}', $benchmarksCount, $card->meta['description']));
$this->registerMetaTag(['name' => 'description', 'content' => ($pageDescription ?? '')]);


$this->params['breadcrumbs'][] = array(
    'label' => Yii::t('app', 'Home'),
    'url' => Yii::$app->homeUrl,
);

$this->params['breadcrumbs'][] = array(
    'label' => Yii::t('app', 'CPU comparison'),
    'url' => Yii::$app->urlManager->createUrl('cpu'),
);

?>
<div class="container">
    <?php
    echo Breadcrumbs::widget([
        'itemTemplate' => "<li>{link}</li>" . "&nbsp/&nbsp",
        'options' => ['class' => 'breadcrumb', 'style' => 'justify-content: center;font-size: 0.9em;background-color:inherit;font-weight: 500;'],
        'homeLink' => false,
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]); ?>
    <?php
    $mobileDetect = new MobileDetect();
    if ($mobileDetect->isMobile()) {
        echo '<ins class="adsbygoogle"
                style="display:block"
                data-ad-client="ca-pub-7958472158675518"
                data-ad-slot="6860105289"
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
    <?php 
    
        
    if ($this->beginCache('cpu-index'.$card->id, 
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
                        <img src="<?= $card->image ?>" alt="<?= $card->name ?>">
                    </div>
                    <div class="big-compare-name">
                        <h1 class="big-compare-name"><?= Yii::t('app', 'Processor') . ' ' . $card->name ?>, <?= Yii::t('app', 'specifications and benchmarks') ?></h1>
                    </div>
                </div>
                <?php
                if ($score) { ?>
                    <div class="box-title" style="display: block;text-align: center;"><?php if ($score) echo "<span class='rating'>$score</span>" ?> <?= Yii::t('app', 'place in the overall ranking CPUs!') ?></div>
                <?php }
                ?>
                <div class="text">
                    <?= $card->meta['card_description'] ?? ''  ?>
                </div>
            </div>

            <div class="row mt-30">
                <div class="col-xl-9">

                    <div class="content-nav">
                        <a href="#specifications" class="to_scroll"><?= Yii::t('app', 'Specifications') ?></a>
                        <a href="#performance_tests" class="to_scroll"><?= Yii::t('app', 'Benchmarks') ?></a>
                        <a href="#synonyms" class="to_scroll"><?= Yii::t('app', 'Synonyms') ?></a>
                    </div>
                    <?php
                    if ($mobileDetect->isMobile()) {
                        echo '<ins class="adsbygoogle"
                            style="display:block"
                            data-ad-client="ca-pub-7958472158675518"
                            data-ad-slot="7338864856"
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
                            data-ad-slot="3142838669"></ins>
                        <script>
                            (adsbygoogle = window.adsbygoogle || []).push({});
                        </script>
                        <ins class="adsbygoogle"
                        style=" text-align:center; width: 336px; height: 280px; display: inline-block;"
                            data-full-width-responsive="true"
                            data-ad-client="ca-pub-7958472158675518"
                            data-ad-slot="2278109867"></ins>
                        <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                        </script></div>
                    ';
                    }
                    ?>
                    <div class="block" id="specifications">
                        <div class="title mb-30">
                            <h2 style="font-size: 20px;align-items: center;font-weight:700;"><?= Yii::t('app', 'Specifications') ?></h2> <span class="mr-4"></span>
                            <div class="title-sub"><?= Yii::t('app', 'Technical data') ?></div>
                        </div>


                        <div class="card-columns mt-30">
                            <?php foreach ($card->specifications as $specifications) : ?>
                                <?php if ($specifications->specification->name == 'Devices using this processor') continue; ?>
                                <div class="box mt-0">

                                    <?php
                                    $descGroup = '';
                                    $group = $specifications->specification->name;
                                    if ($specifications->specification->name == 'CPU generation and family') {
                                        $group = 'CPU family and group';
                                        $descGroup = '<p style="font-size:15px;margin-top: 5px;">' . Yii::t('app', 'General information about the processor') . ' ' . $card->name . '</p>';
                                    } elseif ($specifications->specification->name == 'Memory & PCIe') {
                                        $group = 'Memory specs & PCI';
                                        $descGroup = '<p style="font-size:15px;margin-top: 5px;">' . Yii::t('app', 'Technical characteristics of supported memory, PCI bus') . '</p>';
                                    } elseif ($specifications->specification->name == 'CPU Cores and Base Frequency') {
                                        $group = 'CPU Technical specs';
                                        $descGroup = '<p style="font-size:15px;margin-top: 5px;">' . $card->name . ' ' . Yii::t('app', 'Processor performance parameters, CPU capabilities') . '</p>';
                                    } elseif ($specifications->specification->name == 'Encryption') {
                                        $descGroup = '<p style="font-size:15px;margin-top: 5px;">' . Yii::t('app', 'Hardware security technology') . '</p>';
                                    } elseif ($specifications->specification->name == 'Internal Graphics') {
                                        $group = 'iGPU';
                                        $descGroup = '<p style="font-size:15px;margin-top: 5px;">' . Yii::t('app', 'Built-in graphics chip characteristics') . '</p>';
                                    } elseif ($specifications->specification->name == 'Technical details') {
                                        $group = 'Technologies and extensions';
                                        $descGroup = '<p style="font-size:15px;margin-top: 5px;">' . Yii::t('app', 'Technical capabilities of the processor, information') . '</p>';
                                    } elseif ($specifications->specification->name == 'Hardware codec support') {
                                        $descGroup = '<p style="font-size:15px;margin-top: 5px;">' . Yii::t('app', 'Built-in support for video and image compression standards') . '</p>';
                                    }
                                    ?>
                                    <div class="box-title"><?= Yii::t('app', ucfirst($group)) ?></div>
                                    <?= $descGroup ?>
                                    <ul class="box-list box-list-mini mt-3">
                                        <?php foreach ($specifications->items as $item) : ?>
                                            <?php if ($item->name == 'Name') continue ?>
                                            <?php if ($item->name != 'Instruction set extensions') : ?>
                                                <li class="box-list-item">
                                                    <div class="f1">
                                                        <?= Yii::t('app', $item->name) ?>
                                                    </div>
                                                    <?php if ($item->name === 'Family')
                                                        $familyUrl = '<a href="' . Url::to(['cpu/group', 'name' => $item->value]) . '" target="_blank"><strong>' . Yii::t('app', $item->value) . '</strong></a>';
                                                    else {
                                                        $familyUrl = '<strong>' . Yii::t('app', $item->value) . '</strong>';
                                                    }
                                                    ?>
                                                    <div class="f2">
                                                        <?= $familyUrl ?>
                                                    </div>
                                                </li>
                                            <?php endif ?>
                                        <?php endforeach ?>
                                    </ul>
                                    <?php if ($specifications->specification->name == 'Thermal Management') {
                                        echo '* ' . Yii::t('app', 'see below');
                                    } ?>
                                </div>

                            <?php endforeach; ?>
                            <div class="box mt-0">
                                <div class="box-title"><?= Yii::t('app', 'Positions in all rankings') ?></div>
                                <p style="font-size:15px;margin-top: 5px;"><?= Yii::t('app', 'Common positions') . ' ' . $card->name . ' ' . Yii::t('app', 'CPU in popular benchmarks, for comparison with other models') . '.' ?></p>
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

                                <!-- <ul id="resCpuScore" class="box-list box-list-mini mt-3"></ul>
                                <svg class="spinner" viewBox="0 0 50 50" style="display:none">
                                    <circle class="path" cx="25" cy="25" r="20" stroke="#e4b74b" fill="none" stroke-width="3"></circle>
                                </svg> -->
                                <!-- <button type="submit" id="CpuScore" class="btn btn-yellow btn-medium" style="margin:auto;">View</button> -->
                            </div>

                        </div>
                    </div>
                    <?php
                    if ($mobileDetect->isMobile()) {
                        echo '<ins class="adsbygoogle"
                            style="display:block"
                            data-ad-client="ca-pub-7958472158675518"
                            data-ad-slot="6890511988"
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
                                data-ad-slot="4712701514"></ins>
                            <script>
                                (adsbygoogle = window.adsbygoogle || []).push({});
                            </script>
                            <ins class="adsbygoogle"
                            style=" text-align:center; width: 336px; height: 280px; display: inline-block;"
                                data-full-width-responsive="true"
                                data-ad-client="ca-pub-7958472158675518"
                                data-ad-slot="5547023614"></ins>
                            <script>
                            (adsbygoogle = window.adsbygoogle || []).push({});
                            </script></div>
                    ';
                    }
                    ?>
                    <!-- Performance tests -->
                    <div class="block" id="performance_tests">

                        <div class="title mb-30">
                            <h2 style="font-size: 20px;align-items: center;font-weight:700;"><?= Yii::t('app', 'Benchmarks') ?></h2> <span class="mr-4"></span>
                            <div class="title-sub"><?= Yii::t('app', 'Performance tests') . ' ' ?><?= Yii::t('app', 'CPU') ?></div>
                        </div>

                        <p><?= Yii::t('app', 'Compare the scores of popular benchmarks') . ' ' . $card->name . ' ' . Yii::t('app', 'with other processors to understand the real speed of the CPU when processing content') . '.' ?></p>
                        <p><?= Yii::t('app', 'Tests include mathematical calculations, creation of 3D models, cryptocurrency mining, tests in single and multi-core modes') . '.' ?></p>
                        <div class="row">
                            <?php foreach ($card->benchmarks as $benchmarks) : ?>
                                <div class="col-md-6">
                                    <div class="box mt-0">
                                        <div class="box-title">
                                            <?= $benchmarks->benchmark->name ?>
                                        </div>
                                        <div class="box-subtitle">
                                            <?php $arr = explode('.', $benchmarks->benchmark->description);
                                            echo Yii::t('app', $arr[0]) ?>
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

                                            <?php $k = 0;

                                            foreach ($benchmarks->items as $item) : ?>
                                                <?php
                                                $val = (int) preg_replace('/[^0-9,]/', '', $item->style);
                                                $val = $val +  $koef;
                                                $item->style = 'width: ' . $val . '%; white-space:nowrap;';
                                                ?>

                                                <?php if ($item->name == $card->name || $k < 3) : ?>

                                                    <div class="progress my-progres <?= $card->name == $item->name ? 'yellow' : '' ?>">
                                                        <div class="progress-bar" role="progressbar" style="<?= $item->style ?>">
                                                            <span><?= $item->value ?></span>
                                                        </div>
                                                    </div>
                                                    <div style="font-size: 0.85rem;text-align:center;">
                                                        <!-- <img src="images/temp/amd.png" alt=""> -->
                                                        <?php $cpu = Card::find()->where(['name' => $item->name])->one();
                                                        if ($cpu) { ?>
                                                            <?php if ($card->name != $item->name) { ?>
                                                                <a href="<?= Yii::$app->urlManager->createUrl(['cpu/index', 'alias' => $cpu->alias]) ?>" target="_blank"><?= $item->name ?></a>
                                                            <?php } else {
                                                                echo $item->name;
                                                            } ?>
                                                        <?php } else {
                                                            echo $item->name;
                                                        }
                                                        ?>
                                                    </div>
                                                <?php $k++;
                                                endif; ?>
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
                        <?= app\components\SimilarCpuWidget::widget(['card_id' => $card->id]) ?>
                    </div>
                    <div style="line-height:0.9">
                        <p style="font-size:16px">*</p>
                        <p style="font-size:16px"><?= Yii::t('app', 'PL1 - Amount of heat in watts generated by the processor (or GPU) during normal operation.') ?></p>
                        <p style="font-size:16px"><?= Yii::t('app', 'PL2 - on overclocking') ?></p>
                        <p style="font-size:16px"><?= Yii::t('app', 'The values are used to select the optimal cooling system and power supply.') ?></p>
                    </div>

                    <div class="post-rate">
                        <?= Yii::t('app', 'Rate the processor') ?> <br> <?= $card->name ?>
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

            <?= app\components\LatestCompareWidget::widget(['category' => '1']) ?>

        </div>            
        
        <?php $this->endCache();
    }
    ?>
    
<?php

$position = Yii::t('app', 'place');
$js = <<<JS

$('.rating-input').change(function(e){
    let val = $(this).val();
    let card_id = $card->id
    
    $.post('/cpu/rating', {card_id: card_id, value: val}, (res) => {
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

$jsScoreCpu = <<<JS

$('#CpuScore').on('click', function(e){
    let spinner = $('.spinner');
    let button = $('[type="submit"]');
    button.css("display", "none");
    spinner.css("display", "block");
    let result = $("#resCpuScore");
    result.html('');
    let card_id = $card->id
    let li = '';
    $.get('/cpu-score/bench', {id: card_id}, (res) => {
        
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
$this->registerJs($jsScoreCpu);


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