<?php

use yii\helpers\Url;

?>
<?php if($banner): ?>
    <a href="<?= $banner->link ?>" target="_blank" style="width: 100%; display: flex; justify-content: center">
        <img src="<?= $banner->image ?>" alt="banner" style="width: 100%; max-width: 300px">
    </a>
<?php endif; ?>