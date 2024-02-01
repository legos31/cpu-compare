<?php
use yii\widgets\LinkPager;
$this->title = (Yii::$app->request->get('category') == 1 ? 'Cpu' : 'Gpu') . ' compare list';
$this->registerMetaTag(['name' => 'description', 'content' => (Yii::$app->request->get('category') == 1 ? 'Cpu' : 'Gpu') . ' compare list']);
?>
<div class="container sitemap">
    <h1><?= Yii::$app->request->get('category') == 1 ? 'Cpu' : 'Gpu' ?> compare list</h1>
    <br>
    <?php foreach($cpus as $cpu) : ?>
    <div> <a href="<?= $cpu->url ?>"> <?= $cpu->card1->name ?? '' ?> - vs - <?= $cpu->card2->name ?> </a> </div>
    <?php endforeach; ?>
    <br>
    <br>
    <?php echo LinkPager::widget([
        'pagination' => $pages,
    ]);  ?>
</div>
<style>
    .sitemap{
        padding-top: 100px;
        padding-bottom: 300px;
    }
    .sitemap a{
        font-size: 16px;
        font-weight: 500;
        line-height: 28px;
    }
</style>