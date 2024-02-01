<?php

use yii\helpers\Url;

?>

    <!-- Latest comparisons -->
    <div class="slayder">
        <div class="slayder-title">
            <div class="title">
            <h2 style="font-size: 20px;align-items: center;font-weight:700;"><?=Yii::t('app','Latest comparisons')?></h2>
            </div>
        </div>

        <div class="slayder-content owl-carousel" id="slayder">
            <?php foreach ($latests as $key => $latest): ?>
            <div>
                <a href="<?=Url::to([$latest->category_id == 1 ? 'cpu/compare' : 'gpu/compare', 'vs' => $latest->card1->alias . '-vs-' . $latest->card2->alias])?>" class="compare-card <?=$latest->category_id == 1 ? '' : 'orange'?>">
                    <div class="compare-card-body">
                        <div class="compare-card-left">
                            <div>
                            <?php
                                if ($latest->category_id != 1) { ?>
                                    <img loading="lazy" src="<?=$latest->card1->image_logo?>" alt="<?=$latest->card1->name?>">
                                <?php } else { ?>
                                    <img loading="lazy" src="<?=$latest->card1->image?>" alt="<?=$latest->card1->name?>">
                                <?php }
                                ?>
                            </div>
                            <span> <?=$latest->card1->name?> </span>
                        </div>
                        <div class="compare-card-right">
                            <div>
                                <?php
                                if ($latest->category_id != 1) { ?>
                                    <img loading="lazy" src="<?=$latest->card2->image_logo?>" alt="<?=$latest->card2->name?>">
                                <?php } else { ?>
                                    <img loading="lazy" src="<?=$latest->card2->image?>" alt="<?=$latest->card2->name?>">
                                <?php }
                                ?>
                            </div>
                            <span><?=$latest->card2->name?></span>
                        </div>
                        <div class="compare-card-icon"></div>
                    </div>
                    <div class="compare-card-footer">
                        <?=Yii::t('app', $latest->category->name)?>
                    </div>
                </a>
            </div>
            <?php endforeach;?>


        </div>
    </div>
    <!-- Latest comparisons -->
