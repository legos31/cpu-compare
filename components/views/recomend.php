<?php

?>

<div class="block">
    <div class="title mb-30"><?=Yii::t('app', 'Recommended')?></div>
    <div class="row">
        <?php foreach ($cards as $key => $card): ?>
            <div class="col-md-6 col-lg-4 col-xl-3">
                <div class="review">
                    <img src="<?= $card->image ?>" alt="<?= $card->name ?>">
                    <span><?= $card->name ?></span>
                    <a href="<?= \yii\helpers\Url::to([($card->category_id == 1 ? 'cpu' : 'gpu') . '/index', 'alias' => $card->alias]) ?>" class="btn btn-<?= $card->category_id == 1 ? 'yellow' : 'orange' ?>">See</a>
                </div>
            </div>
        <?php
            if($key >= 3){
                break;
            }
            endforeach; ?>

    </div>
</div>
