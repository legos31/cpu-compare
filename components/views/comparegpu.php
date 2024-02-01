<?php

use yii\helpers\Url;

?>

<div class="sidebar-compare">
    <div class="sidebar-compare-title">
        <h2 style="font-size: 20px;align-items: center;font-weight:700;"><?=$title?></h2>
    </div>
    <?php if ($compare && (count($compare) > 1)) {
        foreach ($compare as $item) : ?>
            <?php
                $card1 = $item->card1;
                $card2 = $item->card2;
            ?>
            <?php if ($card1->id != $card->id) : ?>
                <a href="<?= Url::to(['gpu/compare', 'vs' => $card1->alias . '-vs-' . $card2->alias]) ?>" class="sidebar-compare-item"> 
                    <div class="sidebar-compare-image" style="background-image: url(<?= $card1->image_mini?>);"></div>
                    <span><?= $card1->name ?></span>
                </a>
            <?php else : ?>  
                <a href="<?= Url::to(['gpu/compare', 'vs' => $card1->alias . '-vs-' . $card2->alias]) ?>" class="sidebar-compare-item"> 
                    <div class="sidebar-compare-image" style="background-image: url(<?= $card2->image_mini?>);"></div>
                    <span><?= $card2->name ?></span>
                </a>
            <?php endif ?>    
        <?php endforeach; ?>
    <?php } else {
        foreach ($similar as $item) : ?>
            <a href="<?= Url::to(['gpu/compare', 'vs' => $card->alias . '-vs-' . $item->alias]) ?>" class="sidebar-compare-item">
            <div class="sidebar-compare-image" style="background-image: url(<?= $item->image_mini?>);">
            </div>
            <span><?= $item->name ?></span>
            </a>
        <?php endforeach; ?>
    <?php } ?>  
</div>