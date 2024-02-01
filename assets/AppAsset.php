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
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $cssOptions = ['rel'=>"stylesheet preload",'as'=>'style'];
    public $css = [
        //'https://cpucompare.b-cdn.net/css/style.min.css',
        'css/style3.css',
        'css/new.css',
        'lib/noty/noty.css',
    ];

    public $jsOptions = ['async' => 'async'];
    public $js = [
        'lib/noty/noty.js',
        //'js/main.js',
        //'https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7958472158675518'
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
