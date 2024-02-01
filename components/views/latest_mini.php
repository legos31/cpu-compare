<?php

use yii\helpers\Url;

?>


<div class="sidebar-compare">
    <div class="sidebar-compare-title mb-20">
    <?=Yii::t('app','Latest comparisons')?>
    </div>
    <?php foreach ($latests as $key => $latest): ?>
        <div>
            <a href="<?=Url::to([$latest->category_id == 1 ? 'cpu/compare' : 'gpu/compare', 'vs' => $latest->card1->alias . '-vs-' . $latest->card2->alias])?>" class="compare-card compact <?=$latest->category_id == 1 ? '' : 'orange'?>">
                <div class="compare-card-body">
                    <div class="compare-card-left">
                        <div>
                            <img loading="lazy" src="<?=$latest->card1->image?>" alt="<?=$latest->card1->name?>">
                        </div>
                        <span> <?=$latest->card1->name?> </span>
                    </div>
                    <div class="compare-card-right">
                        <div>
                            <img loading="lazy" src="<?=$latest->card2->image?>" alt="<?=$latest->card2->name?>">
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
