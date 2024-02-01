<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'assetsAutoCompress'],
    //'language' => 'en',
    'sourceLanguage' => 'en',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
        '@common' => '@app/common',
    ],
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
            'layout' => 'main',
        ],
        'languages' => [
            'class' => 'klisl\languages\Module',
            //Языки используемые в приложении
            'languages' => [
                'English' => 'en',
                'Russian' => 'ru',
                'German' => 'de',
                'Portuguese' => 'pt',
                'Italian' => 'it',
                'French' => 'fr',
                'Japan' => 'ja',
                'Spanish' => 'es',
                'Polish' => 'pl',
                'Chinese' => 'zh-CN',
                'Korean' => 'ko',
            ],
            'default_language' => 'en', //основной язык (по-умолчанию)
            'show_default' => false, //true - показывать в URL основной язык, false - нет
        ],
    ],
    'components' => [
        'language'=>'en-EN',
        'i18n' => [
            'translations' => [
                'app' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages',
                    'sourceLanguage' => 'en',
                    'fileMap' => [
                        //'main' => 'main.php',
                    ],
                ],
            ],
        ],
        'assetsAutoCompress' =>
        [
            'class'         => '\skeeks\yii2\assetsAuto\AssetsAutoCompressComponent',
            'enabled' => false,

            'jsFileCompile'                 => true,        //Turning association js files
            'jsFileCompileByGroups'         => false ,       //Enables the compilation of files in groups rather than in a single file. Works only when the $jsFileCompile option is enabled
            'jsFileRemouteCompile'          => false,       //Trying to get a js files to which the specified path as the remote file, skchat him to her.
            'jsFileCompress'                => false,        //Enable compression and processing js before saving a file
            'jsFileCompressFlaggedComments' => true,        //Cut comments during processing js
        ],
        'request' => [
            //'class' => 'app\components\LangRequest',
            'class' => 'klisl\languages\Request',
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'lo[dfgsdhuwhiapdg]146a4sd6fg654dfg983d2gh',
            'baseUrl' => '',
        ],
        'cache' => [
            'class' => 'yii\caching\MemCache',
            'useMemcached' => true,
            'servers' => [
                [
                    'host' => '10.5.4.81',
                    'port' => 11211
                ],
            ],
        ],
        'assetManager' => [
            'appendTimestamp' => true,
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'sourcePath' => null,   // do not publish the bundle
                    'js' => [
                        'https://code.jquery.com/jquery-3.3.1.min.js',
                    ]
                ],
            ],
        ],
        'user' => [
            'identityClass' => 'app\models\Users',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            //'class'=>'app\components\LangUrlManager',
            'class' => 'klisl\languages\UrlManager',
            'rules' => [
                
                // ['class' => 'yii\rest\UrlRule',
                // 'controller' => 'cpu-score',
                // 'except' => ['delete', 'create', 'update'],
                // 'tokens' => [
                //    '{id}' => '<id:\\d+>'
                //     ],
                // 'extraPatterns' => [
                //     //'GET cpu-score' => 'view',
                //     'GET cpu-scores' => 'cpu-score/index',
                //     ],    
                // ],
               
                'languages' => 'languages/default/index', //для модуля мультиязычности
                'site/index' => '/',
                'search' => 'site/search',
                'privacy' => 'site/privacy',
                'all/reviews' => 'site/reviews',
                'parser/cpusupdate' => 'parser/cpusupdate',
                'cpu/compare/<vs>' => 'cpu/compare',
                'cpu/rating' => 'cpu/rating',
                'cpu/reviews' => 'cpu/reviews',
                'cpu/list' => 'cpu/list',
                'cpu/family' => 'cpu/family',
                'cpu/family/list' => 'cpu/group',
                'cpu/autocomplete' => 'cpu/autocomplete',
                'cpu' => 'cpu/main',
                'cpu/<alias>' => 'cpu/index',
                'gpu/compare/<vs>' => 'gpu/compare',
                'gpu/rating' => 'gpu/rating',
                'gpu/reviews' => 'gpu/reviews',
                'gpu/autocomplete' => 'gpu/autocomplete',
                'gpu/list' => 'gpu/list',
                'gpu' => 'gpu/main',
                'gpu/family' => 'gpu/family',
                'gpu/family/list' => 'gpu/group',
                'gpu/<alias>' => 'gpu/index',
                'posts' => 'posts/index',
                'posts/rate' => 'posts/rate',
                'posts/<alias>' => 'posts/page',
                'sitemap.xml' => 'site/sitemap',
                'about' => 'site/about',
                'disclamer' => 'site/disclamer',
            ],
        ],
                
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    //configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['*', '::1'],
    ];

    /* $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['*', '::1'],
    ]; */
}

return $config;
