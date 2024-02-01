<?php

use yii\helpers\Url;
use yii\widgets\LinkPager;


$model = new \app\models\Gpu();

if(isset ($_GET['page'])) {
    $strPage = ($_GET['page'] > 1) ?  Yii::t('app', 'Page ') . $_GET['page'] : '';    
} else {
    $strPage = '';
}

$this->title = Yii::t('app',$model->listmeta['title'])  . ' '. $strPage;

$this->registerMetaTag(['name' => 'description', 'content' => Yii::t('app',$model->listmeta['description'])  . ' '. $strPage]);

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
                            <div class="rating-table-name">TDP </div>
                        </div>
                        <div class="t3">
                            <div class="rating-table-name">Memory size </div>
                        </div>
                        <div class="t4">
                            <div class="rating-table-name">Score</div>
                        </div>
                        <div class="t5">
                            <div class="rating-table-name">Clock speed</div>
                        </div>
                        <div class="t6">
                            <div class="rating-table-name">Memory type</div>
                        </div>
                        <!-- <div class="t7">
                            <div class="rating-table-name">Clock speed</span>
                            </div>
                        </div> -->
                        <div class="t8">
                            <div class="rating-table-name">Price</div>
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
                                <div class="rating-table-name"><?=Yii::t('app', 'GPU')?></div>
                                <div class="t1-flex">
                                    <img src="<?= $card->image_logo ?>" alt="<?= $card->name ?>">
                                    <a href="<?= Url::to(['gpu/index', 'alias' => $card->alias]) ?>"><span><?= $card->name ?></span></a>
                                </div>
                            </div>
                            <div class="t2">
                                <div class="rating-table-name">TDP</div>
                                <?= $card->type ?>
                            </div>
                            <div class="t3">
                                <div class="rating-table-name">Memory size</div>
                                <?= trim($card->memory_size)  ? $card->memory_size : '-' ?>
                            </div>
                            <div class="t4">
                                <div class="rating-table-name">Score</div>
                                <?= trim($card->score) ? $card->score : '-' ?>
                            </div>
                            <div class="t5">
                                <div class="rating-table-name">Clock speed</div>
                                <?= trim($card->hertz) ? $card->hertz : '-' ?>
                            </div>
                            <div class="t6">
                                <div class="rating-table-name">Memory type</div>
                                <?= trim($card->memory_type) ? $card->memory_type : '-' ?>
                            </div>
                            <!-- <div class="t7">
                                <div class="rating-table-name">Clock speed</div>
                                <?//= trim($card->hertz) ? $card->hertz : '-' ?>
                            </div> -->
                            <div class="t8">
                                <div class="rating-table-name">Price</div>
                                <strong><?= trim($card->price) ? $card->price : '-' ?></strong>
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