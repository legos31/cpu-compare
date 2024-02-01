<?php

use yii\helpers\Url;
?>

<div class="tab-title">
    <h2 style="font-size: 20px;align-items: center;font-weight:700;"><?= Yii::t('app', 'Synonyms') ?></h2>
    <span class="mr-4"></span>
    <div class="title-sub"><?= Yii::t('app', 'Similar GPUs in terms of performance.') ?></div>
</div>
<p><?= Yii::t('app', 'Similar in technical data graphics cards with') . ' ' . $card_name . '.' ?></p>

<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade active show" id="opills-all" role="tabpanel" aria-labelledby="pills-profile-tab">
        <div class="row" id="cpu">
            <?php foreach ($results as $result) : ?> 

                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="review">
                        <img loading="lazy" src="<?= $result->image_mini ?>">
                        <span><?= $result->name ?></span>
                        <a href="<?= Url::to(['gpu/index', 'alias' => $result->alias]) ?>" class="btn btn-yellow"><?= Yii::t('app', 'View') ?></a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>

</div>