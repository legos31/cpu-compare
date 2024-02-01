<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\filters\RateLimitInterface;

class IpLimiter extends Model implements RateLimitInterface
{

    public $rateLimit = 3;


// allow less queries then rateLimit for 60 seconds
    public function getRateLimit($request, $action)
    {
        return [$this->rateLimit, 60];
    }

// return remain count of allowed queries and last check time(unix timestamp)
    public function loadAllowance($request, $action)
    {
        $limits = Limits::find()
            ->where(['ip' => Yii::$app->getRequest()->getUserIP()])
            ->one();

        if ($limits) {
            return [$limits->allowance, $limits->timestamp];
        } else {
            return [$this->rateLimit, time()];
        }

    }

// save remain count of allowed queries and current unix timestamp
    public function saveAllowance($request, $action, $allowance, $timestamp)
    {
        $limits = Limits::find()
            ->where(['ip' => Yii::$app->getRequest()->getUserIP()])
            ->one();

        if(!$limits) {
            $limits = new Limits();
            $limits->ip = Yii::$app->getRequest()->getUserIP();
        }
        $limits->allowance = $allowance;
        $limits->timestamp = $timestamp;
        $limits->save();
    }

}