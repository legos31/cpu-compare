<?php

namespace app\controllers;

use app\models\IpLimiter;
use app\models\Reports;
use Yii;
use yii\filters\RateLimiter;
use yii\web\Controller;
use yii\web\Response;

class LimitController extends Controller
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['rateLimiter'] = [
            'class' => RateLimiter::className(),
            'user' => new IpLimiter(),
            'enableRateLimitHeaders' => true
        ];
        return $behaviors;
    }

    public function actionReport(){
        Yii::$app->response->format = Response::FORMAT_JSON;
        if(Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            $report = new Reports();
            $report->text = $post['text'];
            $report->link = $post['link'];
            $report->new = 1;
            $report->page = $_SERVER['HTTP_REFERER'];
            $report->save();
            return Yii::$app->request->headers;
        }
    }

}