<?php

use yii\helpers\Url;

?>
<div class="tab-title">
    <div class="title"><?=Yii::t('app','Popular comparisons')?></div>
</div>

<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
        <div class="row">
            <?php foreach ($cpus as $cpu) : ?>
                <div class="col-xl-4 col-md-6">
                    <a href="<?= Url::to([$cpu->category_id == 1 ? 'cpu/compare' : 'gpu/compare', 'vs' => $cpu->card1->alias . '-vs-' . $cpu->card2->alias]) ?>" class="compare-card orange">
                        <div class="compare-card-body">
                            <div class="compare-card-left">
                                <div>
                                    <img loading="lazy" src="<?= $cpu->card1->image_logo ?>" alt="<?= $cpu->card1->name ?>">
                                </div>
                                <span><?= $cpu->card1->name ?></span>
                            </div>
                            <div class="compare-card-right">
                                <div>
                                    <img loading="lazy" src="<?= $cpu->card2->image_logo ?>" alt="<?= $cpu->card2->name ?>">
                                </div>
                                <span><?= $cpu->card2->name ?></span>
                            </div>
                            <div class="compare-card-icon"></div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>