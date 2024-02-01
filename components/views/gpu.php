<?php

use yii\helpers\Url;

?>

<div class="sidebar-compare">
    <div class="sidebar-compare-title">
    <h2 style="font-size: 20px;align-items: center;font-weight:700;"><?= $cpu1->name ?> <?=Yii::t('app', 'graphics cards comparisons')?></h2>
    </div>
    <?php if ($similar1 && (count($similar1) > 1)) {
        foreach ($similar1 as $item) : ?>
            <?php if ($item->url == $cur_url) continue; ?>
            <?php
                $proc1 = $item->card1;
                $proc2 = $item->card2;
            ?>
            <?php
                $procName = ($proc1->id != $cpu1->id) ? $proc1->name  : $proc2->name;
                $procImage = ($proc1->id != $cpu1->id) ? $proc1->image_logo  : $proc2->image_logo;
            
            ?>
            <a href="<?= Url::to(['gpu/compare', 'vs' => $proc1->alias . '-vs-' . $proc2->alias]) ?>" class="sidebar-compare-item"> 
            <div class="sidebar-compare-image" style="background-image: url(<?= $procImage?>);">
            </div>
            
            
            <span><?= $procName ?></span>
            </a>
        <?php endforeach; ?>
    <?php } else {
        foreach ($similar as $item) : ?>
            <a href="<?= Url::to(['gpu/compare', 'vs' => $cpu1->alias . '-vs-' . $item->alias]) ?>" class="sidebar-compare-item">
            <div class="sidebar-compare-image" style="background-image: url(<?= $item->image_logo?>);">
            </div>
            <span><?= $item->name ?></span>
            </a>
        <?php endforeach; ?>
    <?php } ?>

    <div class="sidebar-compare-title" style="margin-top:20px;">
    <h2 style="font-size: 20px;align-items: center;font-weight:700;"><?= $cpu2->name ?> <?=Yii::t('app', 'graphics cards comparisons')?></h2>
    </div>
            
    <?php if ($similar2 && (count($similar2) > 1)) {
        foreach ($similar2 as $item) : ?>
            <?php if ($item->url == $cur_url) continue; ?>
            <?php
                $proc1 = $item->card1;
                $proc2 = $item->card2;
            ?>

            <?php
                $procName = ($proc1->id != $cpu2->id) ? $proc1->name  : $proc2->name;
                $procImage = ($proc1->id != $cpu1->id) ? $proc1->image_logo  : $proc2->image_logo;
            ?>
            <a href="<?= Url::to(['gpu/compare', 'vs' => $proc1->alias . '-vs-' . $proc2->alias]) ?>" class="sidebar-compare-item"> 
            <div class="sidebar-compare-image" style="background-image: url(<?= $procImage?>);">
            </div>
            
            <span><?= $procName ?></span>
            </a>
        <?php endforeach; ?>
    <?php } else {
        foreach ($similar as $item) : ?>
            <a href="<?= Url::to(['gpu/compare', 'vs' => $cpu2->alias . '-vs-' . $item->alias]) ?>" class="sidebar-compare-item">
            <div class="sidebar-compare-image" style="background-image: url(<?= $item->image_logo?>);">
            </div>
            <span><?= $item->name ?></span>
            </a>
        <?php endforeach; ?>
    <?php } ?>    
</div>