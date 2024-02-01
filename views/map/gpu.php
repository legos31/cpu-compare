<?php
use yii\widgets\LinkPager;

if(isset ($_GET['page'])) {
    $strPage = ($_GET['page'] > 1) ?  Yii::t('app', 'Page ') . $_GET['page'] : '';    
} else {
    $strPage = '';
}

$this->title = 'Gpu list'  . ' '. $strPage;
$this->registerMetaTag(['name' => 'description', 'content' => 'Gpu list'  . ' '. $strPage]);
?>
<div class="container sitemap">
    <h1>Gpu list</h1>
    <br>
    <?php foreach($cpus as $cpu) : ?>
    <div> <a href="/gpu/<?= $cpu->alias ?>"> <?= $cpu->name ?> </a> </div>
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