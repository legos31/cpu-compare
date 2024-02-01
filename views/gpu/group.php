<?php

use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\widgets\Breadcrumbs;

if(isset ($_GET['page'])) {
    $strPage = ($_GET['page'] > 1) ?  Yii::t('app', 'Page ') . $_GET['page'] : '';    
} else {
    $strPage = '';
}

if(isset ($_GET['name'])) {
    $nameSeries = $_GET['name'];
} else {
    $nameSeries = Yii::t('app', 'All');
}
$this->title = $nameSeries . ' ' . Yii::t('app', 'series graphics cards, specifications and tests') . ' '. $strPage;
$this->registerMetaTag(['name' => 'description', 'content' => $nameSeries . ' ' . Yii::t('app', "series graphics cards. Specifications and performance tests") . ' '. $strPage]);

$p = 0;
if (isset($_GET['page']) && $_GET['page'] != 1)
    $p = ($_GET['page'] - 1) * 20;
?>
<?php 

$this->params['breadcrumbs'][] = array(
    'label'=> Yii::t('app', 'Home'),
    'url'=>Yii::$app->homeUrl,
);

$this->params['breadcrumbs'][] = array(
    'label'=> Yii::t('app', 'GPUs groups'),
    'url'=>Yii::$app->urlManager->createUrl('gpu/family'),
);

?>
<div class="container">
    <?php
        echo Breadcrumbs::widget([
            'itemTemplate'=>"<li><i>{link}</i></li> &nbsp/&nbsp \n",
            'options' => ['class' => 'breadcrumb','style' => 'justify-content: center;font-size: 0.9em;background-color:inherit;'],
            'homeLink' => false,
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]); ?>
    <div class="block">
        <div class="title mb-30">
            <h1 class="big-compare-name" style="margin-top:15px;margin-bottom:25px;"><?= Yii::t('app',$this->title) ?></h1>
        </div>
        <p><?=$nameSeries . ' ' .Yii::t('app', "GPU list, features and benchmarks in") . ' ' .date('Y')?></p>
        <div class="rating-table">
            <div class="rating-table-header">
                <div class="rating-table-item">
                    <div class="rating-table-number">
                        <div class="rating-table-name">№</div>
                    </div>
                    <div class="rating-table-content">
                        <div class="t1">
                            <div class="rating-table-name"><?=Yii::t('app', 'GPU')?></div>
                        </div>
                        <div class="t4">
                            <div class="rating-table-name"><?=Yii::t('app', 'Frequency')?></div>
                        </div>
                        <div class="t4">
                            <div class="rating-table-name"><?=Yii::t('app', 'Memory type')?></div>
                        </div>
                        <div class="t5">
                            <div class="rating-table-name"><?=Yii::t('app', 'Memory size')?></div>
                        </div>
                        <div class="t6">
                            <div class="rating-table-name"><?=Yii::t('app', 'Release date')?></div>
                        </div>
                        <div class="t6">
                            <div class="rating-table-name"><?=Yii::t('app', 'Compare')?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="rating-table-body">
                <?php $key = 1 ;?>
                <?php foreach ($cpus as $bench) : ?>
                    
                    <div class="rating-table-item">
                        <div class="rating-table-number">
                            <div class="rating-table-name">№</div>
                            <?= $key + $p;?>
                        </div>
                        <div class="rating-table-content">
                            <div class="t1">
                                <div class="rating-table-name">GPU</div>
                                <div class="t1-flex">
                                    <img src="" alt="">
                                    <a href="<?= Url::to(['gpu/index', 'alias' => $bench->alias])?>"><?=$bench->name?></a>
                                </div>
                            </div>
                            <div class="t4">
                                <div class="rating-table-name">Frequency</div>
                                <?= $bench->hertz ?>
                            </div>
                            <div class="t4">
                                <div class="rating-table-name">Memory type</div>
                                <?=  $bench->memory_type ?>
                            </div>
                            <div class="t5">
                                <div class="rating-table-name">Memory size</div>
                                <?=  $bench->memory_size ?>
                            </div>
                            <div class="t6">
                                <div class="rating-table-name">Release date</div>
                                <?=  $bench->release_date ?>
                            </div>
                            <div class="t6">
                                <div class="rating-table-name">Compare</div>
                                <?=  '<a href="'.Url::to(['gpu/index', 'alias' => $bench->alias]). '" class="btn btn-yellow">'.Yii::t('app', 'Compare').'</a>' ?>
                            </div>
                            
                        </div>
                    </div>
                    <?php $key ++;?>
                <?php endforeach; ?>
            </div>
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