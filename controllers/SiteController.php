<?php

namespace app\controllers;

use app\models\Card;
use app\models\Compare;
use app\models\IpLimiter;
use app\models\Languages;
use app\models\MonkeyGpuParser;
use app\models\MonkeyParser;
use app\models\Pages;
use app\models\ParsedCpus;
use app\models\Reports;
use Yii;
use yii\data\Pagination;
use yii\filters\RateLimiter;
use yii\helpers\Html;
use yii\web\Response;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Gpu;
use linslin\yii2\curl;

class SiteController extends MainController
{
    // public function behaviors()
    // {
    //     return [
    //         'pageCache' => [
    //             'class' => 'yii\filters\PageCache',
    //             'only' => ['index'],
    //             'duration' => 3600 * 24,
    //             'variations' => [
    //                 \Yii::$app->language,
    //             ]
    //         ],
    //     ];
    // }
    
    // public function behaviors()
	// {
	// 	return [
			
	// 		'httpCache' => [
	// 		  'class' => 'yii\filters\HttpCache',
	// 		  'lastModified' => function ($action, $params) {
	// 					return time();
	// 				},
	// 			'sessionCacheLimiter' => 'public',
	// 			'cacheControlHeader' => 'max-age=31536000',
	// 		],
	// 	];
	// }

    /**
     * {@inheritdoc}
     */

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $cpu = new Card();
        $gpu = new Gpu();
        $page = Pages::findOne(1);

        return $this->render('index', [
            'cpu' => $cpu,
            'gpu' => $gpu,
            'page' => $page,
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect('/admin');
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        $page = Pages::findOne(6);
        return $this->render('about', [
            'page' => $page
        ]);
    }

    public function actionSearch($str){
        $str = Html::encode($str);
        $str = explode (' ', $str);
        $query = Card::find()
            ->filterWhere(['like', 'name', $str])
            ->select('name, alias, category_id, image');

        $countQuery = clone $query;
        $cpuPages = new Pagination([
            'totalCount' => $countQuery->count(),
            'pageSize' => 20
        ]);

        $cpus = $query->offset($cpuPages->offset)
            ->limit($cpuPages->limit)
            ->all();

        $query = Gpu::find()
            ->filterWhere(['like', 'name', $str ])
            ->select('name, alias, category_id, image, image_logo');

        $countQuery = clone $query;
        $gpuPages = new Pagination([
            'totalCount' => $countQuery->count(),
            'pageSize' => 20
        ]);

        $gpus = $query->offset($gpuPages->offset)
            ->limit($gpuPages->limit)
            ->all();

        return $this->render('search', [
            'cpus' => $cpus,
            'gpus' => $gpus,
            'gpuPages' => $gpuPages,
            'cpuPages' => $cpuPages,
        ]);
    }

    public function actionSitemap(){
        header('Content-Type: application/xml');
        $host = Yii::$app->request->hostInfo;
        $languages = Languages::find()->all();

        echo '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
        //echo '<urlset xmlns="http://www.google.com/schemas/sitemap/0.84">';
        echo '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        foreach ($languages as $lang){
            echo '
            <sitemap>
                <loc>' . $host . '/sitemaps/' . 'sitemap-' . $lang->code . '.xml.gz</loc>
            </sitemap>';
        }
        //echo PHP_EOL.'</urlset>';
        echo PHP_EOL .'</sitemapindex>';
        exit();
    }

    public function actionReviews(){
        Yii::$app->response->format = Response::FORMAT_JSON;

        $query = Card::find()->orderBy('last_view');
        $countQuery = clone $query;
        $pages = new Pagination([
            'totalCount' => $countQuery->count(),
            'pageSize' => 2
        ]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        $query = Gpu::find()->orderBy('last_view');
        $countQuery = clone $query;
        $pages = new Pagination([
            'totalCount' => $countQuery->count(),
            'pageSize' => 2
        ]);
        $gpus = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        $all = array_merge($models, $gpus);
        shuffle($all);
        return $all;
    }

    // public function actionTest() {
    //     $card = Card::find()->all();
    //     $parsed = ParsedCpus::find()->all();
    //     $list = [];
    //     foreach ($parsed as $item) {
    //         $card  = Card::find()->where(['source_url' => $item->url])->one();
    //         if (!$card){
    //             $list[] = $item->name;
    //         }
    //     }

    //     echo "<pre>";
    //     print_r($list);
    //     echo "</pre>";
    //     exit();
    // }

    public function actionPrivacy() {
        return $this->render('privacy', [
            
        ]);
    }

    public function actionDisclamer()
    {
        $curLang = \Yii::$app->language;
        if ($curLang == 'ru') {
            return $this->render('disclamerru', [
                'curLang' => $curLang,
            ]);
        } else {
            return $this->render('disclamer', [
                'curLang' => $curLang,
            ]);
        }
        
    }
}
