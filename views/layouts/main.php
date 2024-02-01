<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\widgets\Alert;
use lavrentiev\widgets\toastr\Notification;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/icons/favicon.png">

    <?php $baseUrl = Yii::$app->request->pathInfo;  ?>

    <link rel="alternate" hreflang="en" href="https://cpu-compare.com/<?= $baseUrl ?>">
    <link rel="alternate" hreflang="ru" href="https://cpu-compare.com/ru/<?= $baseUrl ?>">
    <link rel="alternate" hreflang="de" href="https://cpu-compare.com/de/<?= $baseUrl ?>">
    <link rel="alternate" hreflang="fr" href="https://cpu-compare.com/fr/<?= $baseUrl ?>">
    <link rel="alternate" hreflang="it" href="https://cpu-compare.com/it/<?= $baseUrl ?>">
    <link rel="alternate" hreflang="zh" href="https://cpu-compare.com/zh-CN/<?= $baseUrl ?>">
    <link rel="alternate" hreflang="es" href="https://cpu-compare.com/es/<?= $baseUrl ?>">
    <link rel="alternate" hreflang="ja" href="https://cpu-compare.com/ja/<?= $baseUrl ?>">
    <link rel="alternate" hreflang="pl" href="https://cpu-compare.com/pl/<?= $baseUrl ?>">
    <link rel="alternate" hreflang="pt" href="https://cpu-compare.com/pt/<?= $baseUrl ?>">
    <link rel="alternate" hreflang="ko" href="https://cpu-compare.com/ko/<?= $baseUrl ?>">
    <link rel="alternate" hreflang="x-default" href="https://cpu-compare.com/<?= $baseUrl ?>">

    <meta name="yandex-verification" content="2a2755fe68796733" />
    <meta name="msvalidate.01" content="90876AC8AE8CD57162F06F3E79871435" />
	<meta name="google-site-verification" content="qIcLS07_1NFWBNiEnojlrS6F-Qorz6pGGTAmwSP2RNM" />
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>

    <?php $this->head() ?>
    <style type="text/css">
        .autocomplete-empty {
            padding: 30px
        }

        .big-compare-top {
            min-height: 54px
        }

        .big-compare-date {
            width: 130px
        }

        .noty_theme__mint.noty_type__success {
            background-color: #AFC765;
            border-bottom: 1px solid #A0B55C;
            color: #fff
        }

        .noty_theme__mint.noty_bar .noty_body {
            padding: 10px;
            font-size: 14px
        }

        .noty_theme__mint.noty_type__error {
            background-color: #DE636F;
            border-bottom: 1px solid #CA5A65;
            color: #fff
        }

        .sidebar-compare-image {
            width: 66px;
            min-width: 66px;
            height: 49px;
            background-size: contain;
            background-position: center;
            background-repeat: no-repeat
        }

        .pagination {
            margin: 0 auto
        }

        .pagination li {
            width: 35px;
            height: 35px;
            background-color: #fff;
            margin: 0 2px;
            border-radius: 4px;
            box-shadow: 0 7px 14px 0 #dee5ed66;
            display: flex;
            align-items: center;
            justify-content: center
        }

        .pagination li a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
            color: #000;
            font-size: 14px
        }

        .pagination li a:hover,
        .pagination li.active a {
            text-decoration: none;
            color: #fff
        }

        .pagination li:hover,
        .pagination li.active {
            background-color: #e4b74b
        }

        .t1-flex a {
            color: #000
        }

        .t1-flex a:hover {
            color: #e4b74b;
            text-decoration: none
        }

        .t2 img {
            height: 28px
        }

        .help-block {
            position: absolute;
            font-size: 12px;
            color: red
        }

        .btn,
        .btn:active,
        .btn:focus {
            outline: none;
            box-shadow: none
        }

        a:hover {
            text-decoration: none
        }

        .comment-count {
            opacity: .3;
            font-weight: 400;
            font-size: 15px;
            margin-left: 15px
        }

        .search {
            position: relative
        }

        .search-result {
            position: absolute;
            top: calc(100% + 3px);
            background: #fff;
            width: 100%;
            border-radius: 22px;
            padding: 10px;
            z-index: 10;
            box-shadow: 0 12px 40px -18px #000;
            display: none
        }

        .search-result a {
            display: block;
            line-height: 30px;
            color: #000;
            text-overflow: ellipsis;
            overflow: hidden;
            white-space: nowrap
        }

        .search-result a:hover {
            color: #e4b74b
        }

        .search-submit {
            cursor: default
        }

        #reportModal.show {
            display: block;
            background: rgba(0, 0, 0, 0.3)
        }

        @media (max-width: 992px) {
            .toast {
                display: none
            }
        }
    </style>
    
</head>

<body>
    
    <?php $this->beginBody() ?>

    <?= \app\components\HeaderWidget::widget() ?>

    <?= Alert::widget() ?>

    <?= $content ?>

    <!-- Modal -->
    <div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"><?= Yii::t('app', 'Report a bug') ?></h5>
                    <button type="button" class="close" id="reportModalClose" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="reportForm">
                        <div class="form-group">
                            <label for="message-text" class="col-form-label"><?= Yii::t('app', 'Bug description') ?></label>
                            <textarea class="form-control" name="text" id="message-text"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Source link</label>
                            <input type="text" class="form-control" name="link" id="recipient-name">
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="send-report" class="btn btn-yellow btn-medium"><?= Yii::t('app', 'Send') ?></button>
                </div>
            </div>
        </div>
    </div>
    <a href="#" class="scrollup"></a>
    <style>
        .scrollup {
            width: 40px;
            height: 40px;
            opacity: 0.3;
            position: fixed;
            bottom: 50px;
            right: 20px;
            display: none;
            text-indent: -9999px;
            background: url('/images/icons/icon_top.png') no-repeat;
        }
    </style>
    <!-- footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-xl-2 col-lg-3 col-md-12">
                    <div class="footer-flex">
                        <div class="footer-logo">
                            <img src="/images/logo-footer.png" alt="" class="l1">
                            <img src="/images/logo.svg" alt="" class="l2">
                        </div>
                        <div class="lang-switcher-top">
                            <?= \app\components\LanguageSwitcher::widget() ?>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-3 col-md-4 col-sm-6">
                    <div class="footer-title"><?= Yii::t('app', 'Processors') ?> <span><i class="arrow down"></i></span></div>
                    <div class="row toggle">
                        <div class="col-xl-6">
                            <a href="<?= Yii::$app->urlManager->createUrl(['benchmark/intel']) ?>" class="footer-link"><?= Yii::t('app', 'Intel rating') ?></a>
                            <a href="<?= Yii::$app->urlManager->createUrl(['benchmark/amd']) ?>" class="footer-link"><?= Yii::t('app', 'AMD rating') ?></a>
                            <a href="<?= Yii::$app->urlManager->createUrl(['benchmark/apple']) ?>" class="footer-link"><?= Yii::t('app', 'Apple rating') ?></a>
                        </div>

                    </div>
                </div>
                <div class="col-xl-4 col-lg-3 col-md-4 col-sm-6">
                    <div class="footer-title"><?= Yii::t('app', 'Video Cards') ?> <span><i class="arrow down"></i></span></div>
                    <div class="row toggle">
                        <div class="col-xl-6">
                            <a href="<?= Yii::$app->urlManager->createUrl(['gpu/list', 'brand' => 9, 'score' => '']) ?>" class="footer-link"><?= Yii::t('app', 'NVIDIA rating') ?></a>
                            <a href="<?= Yii::$app->urlManager->createUrl(['gpu/list', 'brand' => 2, 'score' => '']) ?>" class="footer-link"><?= Yii::t('app', 'AMD rating') ?></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                    <div class="footer-title"><?= Yii::t('app', 'Social') ?> <span><i class="arrow down"></i></span></div>
                    <div class="row toggle">
                        <div class="col-xl-6">
                            <a href="https://www.facebook.com/iCpuCompare/" class="footer-link">Facebook</a>
                            <!-- <a href="/map" class="footer-link"><?= Yii::t('app', 'Site map') ?> </a> -->
                            <a href="<?= Url::to(['site/about']) ?>" class="footer-link">About</a>
                        </div>
                    </div>
                </div>
                <div class="footer-bottom">
                    <div class="row">
                        <div class="col-lg-8">
                            CPU-COMPARE © 2022. <?= Yii::t('app', 'Compare processors and graphics cards to find the best one') ?>!<br>
                            <p style="font-size:12px;"><?= Yii::t('app', 'The data presented on our website are taken from public sources. Please use them at your own risk.') ?></p>
                        </div>
                        <div class="col-lg-2 footer-bottom-link">
                            <a href="/privacy"><?= Yii::t('app', 'Privacy Policy') ?></a>
                        </div>
                        <div class="col-lg-2 footer-bottom-link">
                            <a href="/disclamer"><?= Yii::t('app', 'Disclamer') ?></a>
                        </div>
                    </div>
                </div>
            </div>
            <?= app\components\CookieWidget::widget() ?>
            <?= app\components\LanguageFooterWidget::widget() ?>
    </footer>
    <!-- footer -->

    <?php

    $js = <<<JS

$('.report').click(function(e) {
    e.preventDefault();
    $('#reportModal').addClass('show')
})

$(document).ready(function(){

    $(window).scroll(function(){
        if ($(this).scrollTop() > 100) {
            $('.scrollup').fadeIn();
        } else {
            $('.scrollup').fadeOut();
        }
        });
        
        $('.scrollup').click(function(){
        $("html, body").animate({ scrollTop: 0 }, 600);
        return false;
    });

});

$('#reportModalClose').click(function(){
    $('#reportModal').removeClass('show')
})

$('#send-report').click(function(){
    const arr = $('#reportForm').serializeArray();
    if(!arr[0].value){
        new Noty({
                type: 'error',
                text: 'Fill in the bug description field',
                timeout: 3000 
            }).show();
    }else{
        $.post('/limit/report', arr, function(res) {
            if(res){
                new Noty({
                    type: 'success',
                    text: 'Success',
                    timeout: 3000 
                }).show();
                $('#reportForm').trigger("reset");
            }else{
                new Noty({
                    type: 'error',
                    text: 'Something went wrong',
                    timeout: 3000 
                }).show();
            }
            $('#reportModal').removeClass('show')
        })
    }
})

JS;
    $this->registerJs($js);

    ?>

    <?php $this->endBody() ?>

</body>

</html>
<?php $this->endPage() ?> 

<script type="text/javascript" >
    $( document ).ready(function() {
        (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
        m[i].l=1*new Date();
        for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
        k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

        ym(89669126, "init", {
                clickmap:true,
                trackLinks:true,
                accurateTrackBounce:true
        });
        });
</script>
<script  async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7958472158675518"></script>
<script async src="/js/main.js?v=1633713722"></script>