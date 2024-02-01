<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

\app\assets\AdminAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body>
    <?php $this->beginBody() ?>

    <!-- Main navbar -->
    <div class="navbar navbar-expand-md navbar-dark">
        <div class="navbar-brand wmin-0 mr-5">
            <a href="/" class="d-inline-block">
                <img src="/admin/images/logo.svg" alt="">
            </a>
        </div>

        <div class="d-md-none">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
                <i class="icon-tree5"></i>
            </button>
        </div>

        <div class="collapse navbar-collapse" id="navbar-mobile">


            <span class="badge bg-success-400 badge-pill ml-md-3 mr-md-auto">Online</span>

            <ul class="navbar-nav">


                <li class="nav-item dropdown dropdown-user">
                    <a href="#" class="navbar-nav-link d-flex align-items-center dropdown-toggle" data-toggle="dropdown">
                        <img src="/admin/images/placeholders/placeholder.jpg" class="rounded-circle mr-2" height="34" alt="">
                        <span> <?= Yii::$app->user->identity->username ?? 'User' ?> </span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="#" class="dropdown-item"><i class="icon-user-plus"></i> My profile</a>
                        <div class="dropdown-divider"></div>
                        <a href="<?= Url::to(['/site/logout']) ?>" class="dropdown-item"><i class="icon-switch2"></i> Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <!-- /main navbar -->


    <!-- Secondary navbar -->
    <div class="navbar navbar-expand-md navbar-light">
        <div class="text-center d-md-none w-100">
            <button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-navigation">
                <i class="icon-unfold mr-2"></i>
                Navigation
            </button>
        </div>

        <div class="navbar-collapse collapse" id="navbar-navigation">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="<?= Url::to(['/admin/default']) ?>" class="navbar-nav-link <?= Yii::$app->controller->id == 'default' ? 'active' : '' ?>">
                        <i class="icon-home4 mr-2"></i>
                        Главная
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= Url::to(['/admin/category']) ?>" class="navbar-nav-link <?= Yii::$app->controller->id == 'category' ? 'active' : '' ?>">
                        <i class="icon-grid6 mr-2"></i>
                        Категории
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= Url::to(['/admin/comments']) ?>" class="navbar-nav-link <?= Yii::$app->controller->id == 'comments' ? 'active' : '' ?>">
                        <i class="icon-comments mr-2"></i>
                        Коментарии
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= Url::to(['/admin/reports']) ?>" class="navbar-nav-link <?= Yii::$app->controller->id == 'reports' ? 'active' : '' ?>">
                        <i class="icon-bug2 mr-2"></i>
                        Reports bug
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= Url::to(['/admin/posts']) ?>" class="navbar-nav-link <?= Yii::$app->controller->id == 'posts' ? 'active' : '' ?>">
                        <i class="icon-stack2 mr-2"></i>
                        Статьи
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="navbar-nav-link dropdown-toggle <?= Yii::$app->controller->id == 'cpu' ? 'active' : '' ?>" data-toggle="dropdown">
                        <i class="icon-cog mr-2"></i>
                        SEO
                    </a>

                    <div class="dropdown-menu">
                        <a href="<?= Url::to(['/admin/languages']) ?>" class="dropdown-item">
                            <i class="icon-list2"></i> Языки
                        </a>
                        <a href="<?= Url::to(['/admin/pages']) ?>" class="dropdown-item">
                            <i class="icon-hammer-wrench"></i> Страницы
                        </a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a href="#" class="navbar-nav-link dropdown-toggle <?= Yii::$app->controller->id == 'cpu' ? 'active' : '' ?>" data-toggle="dropdown">
                        <i class="icon-chip mr-2"></i>
                        Процессоры
                    </a>

                    <div class="dropdown-menu">
                        <a href="<?= Url::to(['/admin/card']) ?>" class="dropdown-item">
                            <i class="icon-list2"></i> Список
                        </a>
                        <a href="<?= Url::to(['/admin/specification']) ?>" class="dropdown-item">
                            <i class="icon-hammer-wrench"></i> Характеристики
                        </a>
                        <a href="<?= Url::to(['/admin/benchmark']) ?>" class="dropdown-item">
                            <i class="icon-lab"></i> Benchmark
                        </a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a href="#" class="navbar-nav-link dropdown-toggle <?= Yii::$app->controller->id == 'gpu' ? 'active' : '' ?>" data-toggle="dropdown">
                        <i class="icon-file-video2 mr-2"></i>
                        Видеокарты
                    </a>

                    <div class="dropdown-menu">
                        <a href="<?= Url::to(['/admin/gpu']) ?>" class="dropdown-item">
                            <i class="icon-list2"></i> Список
                        </a>
                        <a href="<?= Url::to(['/admin/specification']) ?>" class="dropdown-item">
                            <i class="icon-hammer-wrench"></i> Характеристики
                        </a>
                        <a href="<?= Url::to(['/admin/benchmark']) ?>" class="dropdown-item">
                            <i class="icon-lab"></i> Benchmark
                        </a>
                    </div>
                </li>

                <li class="nav-item">
                    <a href="<?= Url::to(['/admin/users']) ?>" class="navbar-nav-link <?= Yii::$app->controller->id == 'users' ? 'active' : '' ?>">
                        <i class="icon-users mr-2"></i>
                        Администраторы
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav ml-md-auto">

                <li class="nav-item dropdown">
                    <a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-cog3"></i>
                        <span class="d-md-none ml-2">Settings</span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="#" class="dropdown-item"><i class="icon-user-lock"></i> Account security</a>
                        <a href="#" class="dropdown-item"><i class="icon-statistics"></i> Analytics</a>
                        <a href="#" class="dropdown-item"><i class="icon-accessibility"></i> Accessibility</a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item"><i class="icon-gear"></i> All settings</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <!-- /secondary navbar -->


    <!-- Page header -->
    <div class="page-header">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h3><span class="font-weight-semibold"><?= $this->title ?></span>
                </h3>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>

            <div class="header-elements d-none py-0 mb-3 mb-md-0">
                <?= Breadcrumbs::widget([
                    'itemTemplate' => "<li>{link}</li> / \n",
                    'homeLink' => [
                        'label' => 'Главная ',
                        'url' => Url::to(['/admin']),
                    ],
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
            </div>
        </div>
    </div>
    <!-- /page header -->


    <!-- Page content -->
    <div class="page-content pt-0">

        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Content area -->
            <div class="content">

                <?= Alert::widget() ?>
                <?= $content ?>

            </div>
            <!-- /content area -->

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->


    <!-- Footer -->
    <div class="navbar navbar-expand-lg navbar-light">
        <div class="text-center d-lg-none w-100">
            <button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-footer">
                <i class="icon-unfold mr-2"></i>
                Footer
            </button>
        </div>

        <div class="navbar-collapse collapse" id="navbar-footer">
            <span class="navbar-text">
                &copy; 2020
            </span>


        </div>
    </div>
    <!-- /footer -->

<?php

$js = <<<JS
    
$('.select').select2({
    'placeholder' : 'Выбрать'
});
    
JS;

$this->registerJs($js);

?>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>