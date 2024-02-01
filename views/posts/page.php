<?php

use kartik\rating\StarRating;

$this->title = $post->title ?? ''


?>

<div class="container mt">

    <div class="post-title">
        <h1><?= $post->title ?? '' ?></h1>
        <a href="<?= \yii\helpers\Url::to(['posts/index']) ?>" class="goback">Go back</a>
    </div>

    <div class="row">
        <div class="col-xl-9">

            <div class="post">
                <div class="post-image" style="background-image: url(/<?= $post->image ?? '' ?>);">
                    <div class="post-rating">
                        Post rating
                        <div class="stars">
                            <?php for ($i = 1; $i <= 5; $i++) : ?>
                                <?php if ($i > $post->midRate) : ?>
                                    <img src="/images/icons/star.svg" alt="star">
                                <?php else : ?>
                                    <img src="/images/icons/star-on.svg" alt="star">
                                <?php endif; ?>
                            <?php endfor; ?>

                        </div>
                    </div>
                </div>
                <div class="post-body">
                    <?= $post->body ?? '' ?>
                </div>
                <div class="post-footer">
                    <!-- uSocial -->
                    <script async src="https://usocial.pro/usocial/usocial.js?uid=a34b528c1df30046&v=6.1.5" data-script="usocial" charset="utf-8"></script>
                    <div class="uSocial-Share" data-pid="72b5605f9369937f3683d6f5499b19c2" data-type="share" data-options="round-rect,style1,default,absolute,horizontal,size32,eachCounter0,counter0,mobile_position_right" data-social="twi,vk,fb,telegram,ok"></div>
                    <!-- /uSocial -->
                </div>
            </div>

            <div class="post-rate">
                Rate this post
                <?php
                echo StarRating::widget([
                    'name' => 'rating_44',
                    'id' => 'rate',
                    'value' => $rating->value ?? 0,
                    'pluginOptions' => [
                        'theme' => 'krajee-svg',
                        'filledStar' => '<span class="krajee-icon krajee-icon-star"></span>',
                        'emptyStar' => '<span class="krajee-icon krajee-icon-star"></span>',
                        'step' => 1,
                        'showClear' => false,
                        'showCaption' => false,
                    ]
                ]);

                ?>
            </div>

            <?= \app\components\CommentWidget::widget() ?>
        </div>
        <div class="col-xl-3">
            <?= \app\components\VerticalBannerWidget::widget() ?>

            <?= \app\components\LatestCompareMiniWidget::widget() ?>
        </div>
    </div>



    <!-- Обзоры -->
    <?= app\components\ReviewsWidget::widget() ?>
    <!-- Обзоры -->

</div>

<?php

$id = $post->id ?? null;

$js = <<<JS

$('#rate').change(function(e){
    let value = $(this).val();
    let card_id = $id;
    
    $.post('/posts/rate', {card_id, value}, (res) => {
        console.log(res)
        if(res){
            new Noty({
                type: 'success',
                text: 'Thank you for rating',
                timeout: 3000 
            }).show();
        }else{
            new Noty({
                type: 'error',
                text: 'server error',
                timeout: 3000
            }).show();
        }
    })

})

JS;

$this->registerJs($js);


?>
