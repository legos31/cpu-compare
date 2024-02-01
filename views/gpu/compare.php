<?php

use yii\helpers\Url;
use kartik\rating\StarRating;
use PHPUnit\Util\Log\JSON;
use yii\widgets\ActiveForm;
use yii\widgets\Breadcrumbs;
use app\components\MobileDetect;

// $this->title = $compare->meta['title'];
// $this->registerMetaTag(['name' => 'description', 'content' => ($compare->meta['description'] ?? '')]);

$benchCount = ($benchCount != '') ? '[' . $benchCount . ']' : $benchCount;

$pageTitle = trim(str_replace('{{benchCount}}', $benchCount, $compare->meta['title']));
$this->title = $pageTitle ?? '';


$pageDescription = trim(str_replace('{{benchCount}}', $benchCount, $compare->meta['description']));
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

    <!-- big-compare -->
    <div class="big-compare">
        <div class="row">
            <div class="big-compare-name" style="width: 100%;">
                <h1 class="big-compare-name" style="margin-top: 15px;margin-bottom: 25px;"><?= $card1->name ?> <?= Yii::t('app', 'vs') ?> <?= $card2->name ?>. <?= Yii::t('app', 'Specifications, performance, tests') ?></h1>
            </div>
            <?php
            $mobileDetect = new MobileDetect();
            if ($mobileDetect->isMobile()) {
                echo '<ins class="adsbygoogle"
                style="display:block"
                data-ad-client="ca-pub-7958472158675518"
                data-ad-slot="2951266972"
                data-ad-format="auto"
                data-full-width-responsive="true"></ins>
            <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
            ';
            } else {
                echo '<div style="margin-top:20px;text-align: center;width: 100%;"><ins class="adsbygoogle"
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
            <div class="col-md-6">
                <div class="big-compare-card big-compare-icon" style="max-height: 300px;">
                    <div class="big-compare-top">
                        <div class="big-compare-reyting">
                            <span><?= Yii::t('app', 'Overall score') ?></span>
                            <div class="stars">
                                <?php for ($i = 1; $i <= 5; $i++) : ?>
                                    <?php if ($i > $card1->midRate) : ?>
                                        <img src="/images/icons/star.svg" alt="star">
                                    <?php else : ?>
                                        <img src="/images/icons/star-on.svg" alt="star">
                                    <?php endif; ?>
                                <?php endfor; ?>

                            </div>
                        </div>
                        <div class="big-compare-date text-right">
                            <?= Yii::t('app', 'Released') ?> <br>
                            <?= str_replace('Released', '', $card1->release_date) ?>
                        </div>
                    </div>
                    <div class="big-compare-bottom">
                        <div class="big-compare-image">

                            <img src="<?= $card1->image_logo ?>" alt="<?= $card1->name ?>" style="max-height:100px">
                        </div>
                        <div class="big-compare-name" style="font-size: 16px;"><?= $card1->name ?></div>

                    </div>

                </div>
            </div>
            <div class="col-md-6">
                <div class="big-compare-card" style="max-height: 300px;">
                    <div class="big-compare-top">

                        <div class="big-compare-date">
                            <?= Yii::t('app', 'Released') ?> <br>
                            <?= str_replace('Released', '', $card2->release_date) ?>
                        </div>
                        <div class="big-compare-reyting text-right">
                            <span><?= Yii::t('app', 'Overall score') ?></span>
                            <div class="stars">
                                <?php for ($i = 1; $i <= 5; $i++) : ?>
                                    <?php if ($i > $card2->midRate) : ?>
                                        <img src="/images/icons/star.svg" alt="star">
                                    <?php else : ?>
                                        <img src="/images/icons/star-on.svg" alt="star">
                                    <?php endif; ?>
                                <?php endfor; ?>
                            </div>
                        </div>
                    </div>
                    <div class="big-compare-bottom">
                        <div class="big-compare-image">

                            <img src="<?= $card2->image_logo ?>" alt="<?= $card2->name ?>" style="max-height:100px">
                        </div>
                        <div class="big-compare-name" style="font-size: 16px;"><?= $card2->name ?></div>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <?php if ($this->beginCache('gpu-compare'.$card1->id.'-'.$card2->id, 
        ['variations' => [Yii::$app->language]],
        ['duration' => 3600 * 24],
        
        ))
        { ?>
    <!-- big-compare -->
    <div class="card-columns mt-30" style="column-count: 1;">
        <div class="box mt-0">
            <p><?= Yii::t('app', "What's the best choice") . ' ' . $card1->name . ' ' . Yii::t('app', "or") . ' ' . $card2->name . '? '. Yii::t('app', "Which graphics card is faster?")?></p>
            <p><?= Yii::t('app', "We have prepared a comparison to help you choose the best graphics card. Compare their specifications and benchmarks.") ?></p>

            <?php $str1 = $card1->name; ?>
            <?php if ($card1->hertz) {
                $str1 .= ' ' . Yii::t('app', "has a maximum frequency of") . ' ' . $card1->hertz . '. ';
            }
            if ($card1->memory_size) {
                $str1 .= Yii::t('app', "Memory size") . ' ' . $card1->memory_size . '. ';
            }
            if ($card1->memory_type) {
                $str1 .= Yii::t('app', "Memory type") . ' ' . $card1->memory_type . '. ';
            }
            if ($card1->release_date) {
                $str1 .= Yii::t('app', "Released in") . ' ' . $card1->release_date . '. ';
            }
            ?>
            <p><?= $str1 ?> </p>

            <?php $str2 = $card2->name; ?>
            <?php if ($card2->hertz) {
                $str2 .= ' ' . Yii::t('app', "has a maximum frequency of") . ' ' . $card2->hertz . '. ';
            }
            if ($card2->memory_size) {
                $str2 .= Yii::t('app', "Memory size") . ' ' . $card2->memory_size . '. ';
            }
            if ($card2->memory_type) {
                $str2 .= Yii::t('app', "Memory type") . ' ' . $card2->memory_type . '. ';
            }
            if ($card2->release_date) {
                $str2 .= Yii::t('app', "Released in") . ' ' . $card2->release_date . '. ';
            }
            ?>
            <p><?= $str2 ?> </p>

        </div>
    </div>
    <div class="row mt-30">
        <div class="col-xl-9">

            <div class="content-nav">
                <a href="#differences" class="to_scroll"><?= Yii::t('app', 'Differences') ?></a>
                <a href="#specifications" class="to_scroll"><?= Yii::t('app', 'Specifications') ?></a>
                <a href="#performance_tests" class="to_scroll"><?= Yii::t('app', 'Benchmarks') ?></a>
                <a href="#comments" class="to_scroll"><?= Yii::t('app', 'Testimonials') ?></a>
            </div>

            <!-- diff -->
            <div class="block" id="differences">
                <div class="title">
                    <h2 style="font-size: 20px;align-items: center;font-weight:700;"><?= Yii::t('app', 'Differences') ?></h2>
                </div>
                <div class="box">
                    <div class="box-title">
                        <div class="d-flex align-items-center">
                            <img src="<?= $card1->image_logo ?>" alt="<?= Yii::t('app', 'Videokards') ?>">
                            <span><?= Yii::t('app', 'Reasons to consider') ?> <br> <a href="<?= Yii::$app->urlManager->createUrl(['gpu/index', 'alias' => $card1->alias]) ?>" target="_blank"><?= $card1->name ?></a></span>
                        </div>
                        <a href="#" class="show-more report">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 16 15">
                                <g opacity=".5">
                                    <path d="M7.991 10.296c-.447 0-.821.374-.821.821 0 .447.374.822.821.822.43 0 .821-.375.802-.802.02-.47-.352-.841-.802-.841z" />
                                    <path d="M15.593 13.207c.516-.89.52-1.952.007-2.839l-5.145-8.91C9.945.561 9.025.03 7.995.03c-1.032 0-1.952.536-2.462 1.426l-5.151 8.92c-.513.897-.51 1.964.01 2.855.512.88 1.429 1.41 2.454 1.41h10.277c1.028 0 1.951-.536 2.47-1.433zm-1.117-.644c-.285.493-.791.785-1.356.785H2.843c-.559 0-1.061-.286-1.34-.769-.283-.49-.287-1.074-.004-1.567l5.152-8.916c.279-.49.778-.78 1.343-.78.562 0 1.065.293 1.344.783l5.148 8.916c.276.48.273 1.058-.01 1.548z" />
                                    <path d="M7.787 4.53c-.39.112-.634.467-.634.897.02.26.036.522.056.782l.168 2.947c.02.335.279.578.614.578.335 0 .598-.26.614-.598 0-.204 0-.39.02-.598.036-.634.076-1.268.112-1.902.02-.41.056-.821.075-1.232 0-.148-.02-.28-.075-.41-.168-.369-.559-.556-.95-.464z" />
                                </g>
                            </svg>
                            <span><?= Yii::t('app', 'Report a bug') ?></span>
                        </a>
                    </div>
                    <ul class="box-list">
                        <?php if ($score1) :  ?>
                            <li class="box-list-item">
                                <div class="f1">
                                    <?= '<p>' . Yii::t('app', 'Place in the overall ranking') . '</p>' ?>
                                    <?= '<p style="opacity: .5">' . Yii::t('app', '(based on several benchmarks)') . '</p>' ?>
                                </div>
                                <div class="f2">
                                    <strong><?= $score1->position ?></strong>
                                    <img src="/images/icons/top.svg" alt="left arrow">
                                    <strong><?= Yii::t('app', 'score') ?></strong>
                                </div>

                            </li>
                        <?php endif ?>
                        <?php if ((parseNumber($card1->hertz) > parseNumber($card2->hertz)) && $card1->hertz && $card2->hertz) : ?>
                            <li class="box-list-item">
                                <div class="f1">
                                    <?= '<p>' . Yii::t('app', 'Higher clock speed') . '</p>' ?>
                                    <?= '<p style="opacity: .5">' . Yii::t('app', 'Around') ?> <?= round(100 - parseNumber($card2->hertz) * 100 / parseNumber($card1->hertz)) . '% ' ?><?= Yii::t('app', 'better clock speed') . '</p>' ?>
                                </div>
                                <div class="f2">
                                    <strong><?= $card1->hertz ?></strong>
                                    <img src="/images/icons/arrow-left.svg" alt="left arrow">
                                    <strong><?= $card2->hertz ?></strong>
                                </div>

                            </li>
                        <?php endif; ?>
                        <?php if ((parseNumber($card1->memory_size) > parseNumber($card2->memory_size)) && $card1->memory_size && $card2->memory_size) : ?>
                            <li class="box-list-item">
                                <div class="f1">
                                    <?= '<p>' . Yii::t('app', 'More memory') . '</p>' ?>
                                    <?= '<p style="opacity: .5">' . round(100 - parseNumber($card2->memory_size) * 100 / parseNumber($card1->memory_size)) ?><?= Yii::t('app', '% more memory') . '</p>' ?>
                                </div>
                                <div class="f2">
                                    <strong><?= $card1->memory_size ?></strong>
                                    <img src="/images/icons/arrow-left.svg" alt="left arrow">
                                    <strong><?= $card2->memory_size ?></strong>
                                </div>

                            </li>
                        <?php endif; ?>
                    </ul>
                    <br>
                    <div class="box-title"><?= Yii::t('app', 'Positions in all rankings') ?></div>
                    <p style="font-size:15px;margin-top: 5px;"><?= Yii::t('app', 'Common positions') . ' ' . $card1->name . ' ' . Yii::t('app', 'GPU in popular benchmarks, for comparison with other models') . '.' ?></p>
                    <?php if ($scoreBench1) : ?>
                        <ul class="box-list">
                            <?php foreach ($scoreBench1 as $key => $score) : ?>
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
                    <!-- <button type="submit" id="GpuScore" class="btn btn-yellow btn-medium"><?= Yii::t('app', 'View') ?></button> -->
                    <div class="box-title mt-30">
                        <div class="d-flex align-items-center">
                            <img src=<?= $card2->image_logo ?> alt="<?= Yii::t('app', 'Videokards') ?>">
                            <span><?= Yii::t('app', 'Reasons to consider') ?> <br> <a href="<?= Yii::$app->urlManager->createUrl(['gpu/index', 'alias' => $card2->alias]) ?>" target="_blank"><?= $card2->name ?></a></span>
                        </div>
                        <a href="#" class="show-more report">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 16 15">
                                <g opacity=".5">
                                    <path d="M7.991 10.296c-.447 0-.821.374-.821.821 0 .447.374.822.821.822.43 0 .821-.375.802-.802.02-.47-.352-.841-.802-.841z" />
                                    <path d="M15.593 13.207c.516-.89.52-1.952.007-2.839l-5.145-8.91C9.945.561 9.025.03 7.995.03c-1.032 0-1.952.536-2.462 1.426l-5.151 8.92c-.513.897-.51 1.964.01 2.855.512.88 1.429 1.41 2.454 1.41h10.277c1.028 0 1.951-.536 2.47-1.433zm-1.117-.644c-.285.493-.791.785-1.356.785H2.843c-.559 0-1.061-.286-1.34-.769-.283-.49-.287-1.074-.004-1.567l5.152-8.916c.279-.49.778-.78 1.343-.78.562 0 1.065.293 1.344.783l5.148 8.916c.276.48.273 1.058-.01 1.548z" />
                                    <path d="M7.787 4.53c-.39.112-.634.467-.634.897.02.26.036.522.056.782l.168 2.947c.02.335.279.578.614.578.335 0 .598-.26.614-.598 0-.204 0-.39.02-.598.036-.634.076-1.268.112-1.902.02-.41.056-.821.075-1.232 0-.148-.02-.28-.075-.41-.168-.369-.559-.556-.95-.464z" />
                                </g>
                            </svg>
                            <span><?= Yii::t('app', 'Report a bug') ?></span>
                        </a>
                    </div>

                    <ul class="box-list">
                        <?php if ($score2) :  ?>
                            <li class="box-list-item">
                                <div class="f1">
                                    <?= '<p>' . Yii::t('app', 'Place in the overall ranking') . '</p>' ?>
                                    <?= '<p style="opacity: .5">' . Yii::t('app', '(based on several benchmarks)') . '</p>' ?>
                                </div>
                                <div class="f2">
                                    <strong><?= $score2->position ?></strong>
                                    <img src="/images/icons/top.svg" alt="left arrow">
                                    <strong><?= Yii::t('app', 'score') ?></strong>
                                </div>

                            </li>
                        <?php endif ?>
                        <?php if (parseNumber($card2->hertz) > parseNumber($card1->hertz) && $card1->hertz && $card2->hertz) : ?>
                            <li class="box-list-item">
                                <div class="f1">
                                    <?= '<p>' .  Yii::t('app', 'Higher clock speed') . '</p>' ?>
                                    <?= '<p style="opacity: .5">' . Yii::t('app', 'Around') ?> <?= round(100 - parseNumber($card1->hertz) * 100 / parseNumber($card2->hertz)) . '% ' ?><?= Yii::t('app', 'better clock speed') . '</p>' ?>
                                </div>
                                <div class="f2">
                                    <strong><?= $card2->hertz ?></strong>
                                    <img src="/images/icons/arrow-left.svg" alt="left arrow">
                                    <strong><?= $card1->hertz ?></strong>
                                </div>

                            </li>
                        <?php endif; ?>
                        <?php if ((parseNumber($card1->memory_size) < parseNumber($card2->memory_size)) && $card1->memory_size && $card2->memory_size) : ?>
                            <li class="box-list-item">
                                <div class="f1">
                                    <?= '<p>' .  Yii::t('app', 'More memory') . '</p>' ?>
                                    <?= '<p style="opacity: .5">' . round(100 - parseNumber($card1->memory_size) * 100 / parseNumber($card2->memory_size)) ?><?= Yii::t('app', '% more memory') . '</p>' ?>
                                </div>
                                <div class="f2">
                                    <strong><?= $card2->memory_size ?></strong>
                                    <img src="/images/icons/arrow-left.svg" alt="left arrow">
                                    <strong><?= $card1->memory_size ?></strong>
                                </div>

                            </li>
                        <?php endif; ?>

                    </ul>
                    <br>
                    <div class="box-title"><?= Yii::t('app', 'Positions in all rankings') ?></div>
                    <p style="font-size:15px;margin-top: 5px;"><?= Yii::t('app', 'Common positions') . ' ' . $card2->name . ' ' . Yii::t('app', 'GPU in popular benchmarks, for comparison with other models') . '.' ?></p>
                    <?php if ($scoreBench2) : ?>
                        <ul class="box-list">
                            <?php foreach ($scoreBench2 as $key => $score) : ?>
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

                    <!-- <ul id="resGpuScore2" class="box-list box-list-mini mt-3"></ul>
                    <svg class="spinner2" viewBox="0 0 50 50" style="display:none">
                        <circle class="path" cx="25" cy="25" r="20" stroke="#e4b74b" fill="none" stroke-width="3"></circle>
                    </svg>
                    <button type="submit" id="GpuScore2" class="btn btn-yellow btn-medium"><?= Yii::t('app', 'View') ?></button> -->
                </div>


            </div>
            <!-- diff -->

            <!-- specs -->
            <div class="block" id="specifications">
                <div class="title mb-30">
                    <h2 style="font-size: 20px;align-items: center;font-weight:700;"><?= Yii::t('app', 'Specifications') ?></h2> <span class="mr-4"></span>
                    <div class="title-sub"><?= Yii::t('app', 'Technical data') ?>
                    </div>
                </div>

                <div class="mini-compare">
                    <div>
                        <img style="height: 46px" src="<?= $card1->image_logo ?>" alt="<?= $card1->name ?>">
                        <span><?= $card1->name ?></span>
                    </div>
                    <div style="display: flex;">
                        <span><?= $card2->name ?></span>
                        <img style="height: 46px" src="<?= $card2->image_logo ?>" alt="<?= $card2->name ?>">
                    </div>
                </div>
                <?php
                if ($mobileDetect->isMobile()) {
                    echo '<ins class="adsbygoogle"
                style="display:block"
                data-ad-client="ca-pub-7958472158675518"
                data-ad-slot="6698940290"
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
                    data-ad-slot="1607778605"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
                <ins class="adsbygoogle"
                style=" text-align:center; width: 336px; height: 280px; display: inline-block;"
                    data-full-width-responsive="true"
                    data-ad-client="ca-pub-7958472158675518"
                    data-ad-slot="4521129829"></ins>
                <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
                </script></div>
            ';
                }
                ?>
                <div class="card-columns mt-30">
                    <?php foreach ($specifications as $group => $items) : ?>
                        <div class="box mt-0">
                            <?php
                            $descGroup = '';
                            if ($group == 'GPU') {
                                $group = 'General info';
                                $descGroup = '<p style="font-size:15px;margin-top: 5px;">' . Yii::t('app', 'Comparison of basic technical data of graphics cards') . ' ' . $card1->name . ' ' . Yii::t('app', 'and') . ' ' . $card2->name . ', ' . Yii::t('app', 'chip, information processing units') . '.' . '</p>';
                            } elseif ($group == 'Connectivity') {
                                $group = 'Interfaces';
                                $descGroup = '<p style="font-size:15px;margin-top: 5px;">' . Yii::t('app', 'Connectivity and connections') . '.' . '</p>';
                            } elseif ($group == 'Memory') {
                                $group = 'Memory settings';
                                $descGroup = '<p style="font-size:15px;margin-top: 5px;">' . Yii::t('app', 'Comparison of the amount of memory on board graphics cards. The more the better') . '.' . '</p>';
                            } elseif ($group == 'Featureset') {
                                $group = 'Technical data';
                                $descGroup = '<p style="font-size:15px;margin-top: 5px;">' . Yii::t('app', 'Technical data that is used to its full potential in computer games') . '.' . '</p>';
                            } elseif ($group == 'Clock Speeds') {
                                $group = 'Clock frequency';
                                $descGroup = '<p style="font-size:15px;margin-top: 5px;">' . Yii::t('app', "Let's compare the memory frequency of graphics cards") . ' ' . $card1->name . ' ' . Yii::t('app', 'and') . ' ' . $card2->name . '. ' . Yii::t('app', 'The higher the better') . '.' . '</p>';
                            } elseif ($group == 'Supported Video Codecs') {
                                $descGroup = '<p style="font-size:15px;margin-top: 5px;">' . Yii::t('app', 'Built-in support for video and image compression standards') . '.' . '</p>';
                            } elseif ($group == 'Thermal Design') {
                                $group = 'Thermal Management';
                                $descGroup = '<p style="font-size:15px;margin-top: 5px;">' . Yii::t('app', 'Connectors, the number of thermal watts emitted in normal mode and at overclocking') . '.' . '</p>';
                            } elseif ($group == 'Cooler & Fans') {
                                $group = 'Cooler & Fans type';
                                $descGroup = '<p style="font-size:15px;margin-top: 5px;">' . Yii::t('app', 'Types and sizes of coolers for graphics card cooling system') . ' ' . $card1->name . ' ' . Yii::t('app', 'and') . ' ' . $card2->name . '.' . '</p>';
                            } elseif ($group == 'Additional data') {
                                $group = 'More information';
                                $descGroup = '<p style="font-size:15px;margin-top: 5px;">' . Yii::t('app', 'Comparison of interfaces and release dates for GPU') . ' ' . $card2->name . ' ' . Yii::t('app', 'and') . ' ' . $card1->name . '.' . '</p>';
                            } elseif ($group == 'Dimensions') {
                                $descGroup = '<p style="font-size:15px;margin-top: 5px;">' . Yii::t('app', 'The difference in size, weight and slot of the compared devices') . '</p>';
                            }
                            ?>
                            <div class="box-title"> <?= Yii::t('app', ucfirst($group)) ?> </div>
                            <p><?= $descGroup ?></p>
                            <ul class="box-list box-list-short mt-3">
                                <?php foreach ($items as $title => $value) : ?>
                                    <?php if ($title != 'Instruction set extensions' && count($value) == 2) : ?>
                                        <li class="box-list-item">
                                            <div class="f1">
                                                <?= Yii::t('app', $title) ?>
                                            </div>
                                            <div class="f2">
                                                <strong> <?= Yii::t('app', $value[0] ?? '-') ?> </strong>
                                                <img src="/images/icons/range.svg" alt="left arrow">
                                                <strong><?= Yii::t('app', $value[1] ?? '-') ?></strong>
                                            </div>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endforeach; ?>
                </div>


            </div>
            <!-- specs -->
            <?php
            if ($mobileDetect->isMobile()) {
                echo '<ins class="adsbygoogle"
                    style="display:block"
                    data-ad-client="ca-pub-7958472158675518"
                    data-ad-slot="3850798560"
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
                    data-ad-slot="7121612127"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
                <ins class="adsbygoogle"
                style=" text-align:center; width: 336px; height: 280px; display: inline-block;"
                    data-full-width-responsive="true"
                    data-ad-client="ca-pub-7958472158675518"
                    data-ad-slot="1416206913"></ins>
                <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
                </script></div>
            ';
            }
            ?>
            <!-- performance -->
            <div class="block" id="performance_tests">
                <div class="title mb-30">
                    <h2 style="font-size: 20px;align-items: center;font-weight:700;"><?= Yii::t('app', 'Benchmarks') ?> </h2><span class="mr-4"></span>
                    <div class="title-sub"><?= Yii::t('app', 'Performance tests') . ' GPUs' ?>
                    </div>
                </div>
                <p><?= Yii::t('app', 'Based on the results of several popular benchmarks, you can more accurately estimate the performance difference between') . ' ' . $card1->name . ' ' . Yii::t('app', 'and') . ' ' . $card2->name . '.' ?></p>
                <p><?= Yii::t('app', 'Compare synthetic benchmarks and choose the best graphics card for you!') ?></p>

                <div class="row">
                    <?php foreach ($benchmarks as $key => $benchmark) : ?>
                        <div class="col-md-6">
                            <div class="box mt-0">
                                <div class="box-title">
                                    <?= Yii::t('app', $key) ?>
                                </div>
                                <div class="box-subtitle">
                                    <?= Yii::t('app', explode('.', $benchmark['description'])[0]) ?>
                                </div>
                                <div class="box-body">
                                    <?php
                                    $maxValue = 0;
                                    $valStyle = 0;
                                    $koef = 0;
                                    foreach ($benchmark['items'] as $item) {
                                        $currValue = (int) preg_replace('/[^0-9,]/', '', $item['style']);
                                        if ($currValue > $maxValue) {
                                            $maxValue = $currValue;
                                        }
                                    }
                                    if ($maxValue < 40) $koef = 40;
                                    ?>

                                    <?php foreach ($benchmark['items'] as $item) : ?>
                                        <?php
                                        $val = (int) preg_replace('/[^0-9,]/', '', $item['style']);
                                        $val = $val +  $koef;
                                        $item['style'] = 'width: ' . $val . '%; white-space:nowrap;min-width: 20%';
                                        ?>
                                        <div class="progress my-progres yellow">
                                            <div class="progress-bar" role="progressbar" style="<?= $item['style'] ?>" aria-valuenow="<?= preg_replace('/[^0-9]/', '', $item['style']) / 10 ?>" aria-valuemin="0" aria-valuemax="100">
                                                <span><?= Yii::t('app', $item['value']) ?></span>
                                            </div>
                                        </div>
                                        <div style="font-size: 0.85rem;text-align:center;">
                                            <!-- <img src=""> -->
                                            <span><?= Yii::t('app', $item['name']) ?></span>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <?php
                    $testPerformance1 = \app\models\GpuBenchmark::find()->where(['gpu_id' => $card1->id, 'benchmark_id' => 132])->one();
                    $testPerformance2 = \app\models\GpuBenchmark::find()->where(['gpu_id' => $card2->id, 'benchmark_id' => 132])->one();
                    if ($testPerformance1) : ?>
                        <div class="col-md-6">
                            <div class="box mt-0">
                                <div class="box-title">
                                    <?= $card1->name . ' ' . Yii::t('app', 'Performance relative to other GPU chips') ?>
                                </div>
                                <div class="box-subtitle">

                                </div>
                                <div class="box-body">
                                    <?php
                                    $maxValue = 0;
                                    $valStyle = 0;
                                    foreach ($testPerformance1->item as $item) {
                                        $currValue = (int) preg_replace('/[^0-9,]/', '', $item['value']);
                                        if ($currValue > $maxValue) {
                                            $maxValue = $currValue;
                                        }
                                    }
                                    ?>
                                    <?php foreach ($testPerformance1->item as $item) : ?>
                                        <?php
                                        $val = (int) preg_replace('/[^0-9,]/', '', $item['value']);
                                        $val = ($val * 100) / $maxValue;
                                        $iStyle = 'width: ' . $val . '%; white-space:nowrap;min-width: 20%';
                                        ?>
                                        <div class="progress my-progres yellow">
                                            <div class="progress-bar" role="progressbar" style="<?= $iStyle ?>" aria-valuenow="<?= preg_replace('/[^0-9]/', '', $iStyle) / 10 ?>" aria-valuemin="0" aria-valuemax="100">
                                                <span><?= Yii::t('app', $item['value']) ?></span>
                                            </div>
                                        </div>
                                        <div style="font-size: 0.85rem;text-align:center;">
                                            <!-- <img src=""> -->
                                            <?php
                                            if ($card1->name == $item['name']) {
                                                $gpuUrl = Yii::$app->urlManager->createUrl(['gpu/index', 'alias' => $card1->alias]);
                                                echo '<a href="' . $gpuUrl . '">' . $item['name'] . '</a>';
                                            } else {

                                                echo '<span>' . $item['name'] . '</span>';
                                            }
                                            ?>

                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif ?>
                    <?php
                    if ($testPerformance2) : ?>
                        <div class="col-md-6">
                            <div class="box mt-0">
                                <div class="box-title">
                                    <?= $card2->name . ' ' . Yii::t('app', 'Performance relative to other GPU chips') ?>
                                </div>
                                <div class="box-subtitle">

                                </div>
                                <div class="box-body">
                                    <?php
                                    $maxValue = 0;
                                    $valStyle = 0;
                                    foreach ($testPerformance2->item as $item) {
                                        $currValue = (int) preg_replace('/[^0-9,]/', '', $item['value']);
                                        if ($currValue > $maxValue) {
                                            $maxValue = $currValue;
                                        }
                                    }
                                    ?>
                                    <?php foreach ($testPerformance2->item as $item) : ?>
                                        <?php
                                        $val = (int) preg_replace('/[^0-9,]/', '', $item['value']);
                                        $val = ($val * 100) / $maxValue;
                                        $iStyle = 'width: ' . $val . '%; white-space:nowrap;min-width: 20%';
                                        ?>
                                        <div class="progress my-progres yellow">
                                            <div class="progress-bar" role="progressbar" style="<?= $iStyle ?>" aria-valuenow="<?= preg_replace('/[^0-9]/', '', $iStyle) / 10 ?>" aria-valuemin="0" aria-valuemax="100">
                                                <span><?= Yii::t('app', $item['value']) ?></span>
                                            </div>
                                        </div>
                                        <div style="font-size: 0.85rem;text-align:center;">
                                            <!-- <img src=""> -->
                                            <?php
                                            if ($card2->name == $item['name']) {
                                                $gpuUrl = Yii::$app->urlManager->createUrl(['gpu/index', 'alias' => $card2->alias]);
                                                echo '<a href="' . $gpuUrl . '">' . $item['name'] . '</a>';
                                            } else {

                                                echo '<span>' . $item['name'] . '</span>';
                                            }
                                            ?>

                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif ?>
                </div>


            </div>
            <!-- performance -->

        </div>

        <div class="col-xl-3">
            <?= app\components\CompareSimilarGpuWidget::widget(['gpu1_id' => $card1->id, 'gpu2_id' => $card2->id, 'cur_url' => $compare->url]) ?>
            <?php
            if (!$mobileDetect->isMobile()) {
                echo '
            <div class="legos-ads" style="position: -webkit-sticky;position:sticky;top:10px;margin-top:20px;">
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
        
    <?= app\components\LatestCompareWidget::widget(['category' => '2']) ?>


</div>
<?php
$position = Yii::t('app', 'place');
$jsScoreGpu = <<<JS

$('#GpuScore').on('click', function(e){
    let spinner = $('.spinner');
    let button = $('#GpuScore');
    button.css("display", "none");
    spinner.css("display", "block");
    let result = $("#resGpuScore");
    result.html('');
    let card_id = $card1->id
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

$('#GpuScore2').on('click', function(e){
    let spinner = $('.spinner2');
    let button = $('#GpuScore2');
    button.css("display", "none");
    spinner.css("display", "block");
    let result = $("#resGpuScore2");
    result.html('');
    let card_id = $card2->id
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
$this->registerJs($jsScoreGpu);
?>

<style>
    .spinner,
    .spinner2 {
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