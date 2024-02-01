<?php

use yii\helpers\Url;
use yii\widgets\LinkPager;

$page = Yii::$app->request->get('page');
$tab = Yii::$app->request->get('tab');

?>


<div class="container mt">

    <div class="row">
        <div class="col-xl-9">
            <div class="tab-title mt-0">
                <div class="title">Posts</div>
                <ul class="my-tab nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link <?= $tab ? '' : 'active' ?>" href="<?= Url::to(['posts/index']) ?>">All</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link <?= $tab == 'cpu' ? 'active' : '' ?>" href="<?= Url::to(['posts/index', 'tab' => 'cpu']) ?>">Processors (Cpu)</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link <?= $tab == 'gpu' ? 'active' : '' ?>" href="<?= Url::to(['posts/index', 'tab' => 'gpu']) ?>">
                            Video cards (GPU)
                        </a>
                    </li>
                </ul>
            </div>

            <div class="post-list">
                <?php foreach ($posts as $post): ?>
                    <div class="post-list-item">
                        <div class="post-list-image" style="background-image: url(<?= '/' . $post->image ?>);"></div>
                        <div class="post-list-body" style="width: -webkit-fill-available;">
                            <a href="<?= \yii\helpers\Url::to(['posts/page', 'alias' => $post->alias]) ?>" class="post-list-title"><?= $post->title ?></a>
                            <div class="post-list-text"><?= $post->description ?></div>
                            <div class="post-list-actions">
                                <div class="post-list-info">
                                            <span>
                                                <img src="/images/icons/calendar.svg" alt="">
                                                <?= Yii::$app->formatter->asDate($post->date) ?>
                                            </span>

                                    <span>
                                                <img src="/images/icons/eye.svg" alt="">
                                                <?= $post->views ?>
                                            </span>
                                </div>
                                <a href="<?= \yii\helpers\Url::to(['posts/page', 'alias' => $post->alias]) ?>">
                                    <img src="/images/icons/arrow-right-orange.svg" alt="">
                                </a>
                            </div>

                        </div>
                    </div>
                <?php endforeach; ?>

                <div class="d-flex justify-content-center">
                    <?php echo LinkPager::widget([
                        'pagination' => $pages,
                    ]);  ?>
                </div>
            </div>
        </div>
        <div class="col-xl-3">
            <?= \app\components\VerticalBannerWidget::widget() ?>

            <?= \app\components\LatestCompareMiniWidget::widget() ?>
        </div>
    </div>



    <?= \app\components\RecomendedWidget::widget() ?>

</div>
