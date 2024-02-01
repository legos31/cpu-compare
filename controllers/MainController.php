<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;

class MainController extends Controller
{
    public function beforeAction($action)
    {
        $currUrl = Yii::$app->request->absoluteUrl;
		$current_url = explode("?", $currUrl);
		$url = $current_url[0];
        Yii::$app->view->registerLinkTag(['rel' => 'canonical', 'href' => $url ]);
        $cookies = Yii::$app->response->cookies;
        $cookies_req = Yii::$app->request->cookies;
        if (!$cookies_req->has('uniqid')) {
            $cookies->add(new \yii\web\Cookie([
                'name' => 'uniqid',
                'value' => uniqid(),
                'expire' => time() + 60 * 24 * 60 * 60
            ]));
        }
        return parent::beforeAction($action);
    }
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post', 'get'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
}
