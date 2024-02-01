<?php

use yii\helpers\Url;

$this->title = Yii::t('app', 'All graphics cards series');

$this->registerMetaTag(['name' => 'description', 'content' => 'All graphics cards by series group, family']);

?>


<div class="container">

    <div class="block">
        
        
    <div class="tab-title">
        <div class="title"><?=Yii::t('app', 'All graphics cards series')?></div>
    </div>

    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade active show" id="opills-all" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div class="row" id="cpu">
                <?php foreach ($groups as $group) : ?>
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="review">
                            <img loading="lazy" src="<?= $group['img'] ?>">
                            <span><?= $group['based on'] ?></span>
                            <a href="<?= Url::to (['gpu/group', 'name' => $group['based on']]) ?>" class="btn btn-yellow"><?=Yii::t('app', 'View')?></a>
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