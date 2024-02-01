<?php

use yii\helpers\Url;

$this->title = Yii::t('app', 'All processors series');

$this->registerMetaTag(['name' => 'description', 'content' => 'All processors by series group, family']);

?>


<div class="container">

    <div class="block">
        
        
    <div class="tab-title">
        <div class="title"><?=Yii::t('app', 'All processors series')?></div>
    </div>

    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade active show" id="opills-all" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div class="row" id="cpu">
                <?php foreach ($groups as $group) : ?>
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="review">
                            <img loading="lazy" src="<?= $group['img'] ?>">
                            <span><?= $group['family'] ?></span>
                            <a href="<?= Url::to (['cpu/group', 'name' => $group['family']]) ?>" class="btn btn-yellow"><?=Yii::t('app', 'View')?></a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            
        </div>
    
    </div>

    </div>


    <!-- latest compare -->
    <?= app\components\LatestCompareWidget::widget() ?>

</div>