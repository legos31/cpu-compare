<div class="lang-switcher">
    <div class="menu-item">
        <a href="#" class="menu-link dropdown">
            <img src="/images/flags/<?= \Yii::$app->language ?? 'en' ?>.svg" alt="<?= \Yii::$app->language; ?>">
        </a>
        
        <div class="menu-dropdown">
            <?php foreach ($langs as $lang): ?>
                <?php if ($path) : ?>
                    <?php if ($queryString) :?>
                        <a href="/<?= $lang->code . '/'.$path. '?'. $queryString ?>" class="lang-switcher-item">
                            <img src="/images/flags/<?= $lang->code ?>.svg" alt="<?=$lang->name?>"> <?= $lang->name ?>
                        </a>
                    <?php else : ?>
                        <a href="/<?= $lang->code . '/'.$path ?>" class="lang-switcher-item">
                            <img src="/images/flags/<?= $lang->code ?>.svg" alt="<?=$lang->name?>"> <?= $lang->name ?>
                        </a>
                    <?php endif ?>
                <?php else: ?>
                    <a href="/<?= $lang->code . '/'?>" class="lang-switcher-item">
                        <img src="/images/flags/<?= $lang->code ?>.svg" alt="<?=$lang->name?>"> <?= $lang->name ?>
                    </a>
                <?php endif ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>