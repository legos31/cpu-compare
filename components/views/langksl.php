
<div class="lang-switcher">
    <div class="menu-item">
        <a href="#" class="menu-link dropdown">
            <img src="/images/flags/<?= \Yii::$app->language ?? 'en' ?>.svg" alt="<?= \Yii::$app->language; ?>">
        </a>
        
        <div class="menu-dropdown">
            <?php foreach ($array_lang as $key => $lang): ?>
                <?=  $lang ?>
                 <!-- <img src="/images/flags/1.svg" alt=""> -->
            <?php endforeach; ?>        
        </div>
    </div>
</div>