<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AdminAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'admin/css/icons/icomoon/styles.min.css',
        'admin//css/bootstrap.min.css',
        'admin/css/bootstrap_limitless.min.css',
        'admin/css/layout.min.css',
        'admin/css/components.css',
        'admin/css/colors.min.css',
        'admin/form-select2/select2.min.css',
        'admin/css/site.css',
    ];
    public $js = [
//        'admin/js/main/jquery.min.js',
        'admin/js/main/bootstrap.bundle.min.js',
        'admin/js/plugins/loaders/blockui.min.js',
        'admin/js/plugins/ui/slinky.min.js',
        'admin/js/plugins/summernote/summernote.min.js',
        'admin/js/plugins/styling/uniform.min.js',
        'admin/form-select2/select2.full.min.js',
        'admin/js/app.js',
        'admin/js/editor_summernote.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
    ];
}
