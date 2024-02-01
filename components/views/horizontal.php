<?php

use yii\helpers\Url;

?>
<?php if($banner): ?>
    <div style="display: flex; justify-content: center">
        <a href="<?= $banner->link ?>" target="_blank" style="width: 100%; max-width: 768px">
            <img src="<?= $banner->image ?>" alt="banner" style="width: 100%">
        </a>
    </div>
<?php endif; ?>