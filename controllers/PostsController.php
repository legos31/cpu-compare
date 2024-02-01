<?php

namespace app\controllers;

use app\models\PostRating;
use app\models\Posts;
use app\models\Ratings;
use Yii;
use yii\data\Pagination;
use yii\helpers\Html;
use yii\web\Response;

class PostsController extends MainController
{
    public function actionIndex(){
        $query = Posts::find()->orderBy('date desc');
        $tab = \Yii::$app->request->get('tab');
        if($tab == 'gpu'){
            $query = $query->where(['category_id' => 2]);
        }else if($tab == 'cpu'){
            $query = $query->where(['category_id' => 1]);
        }

        $countQuery = clone $query;
        $pages = new Pagination([
            'totalCount' => $countQuery->count(),
            'pageSize' => 10
        ]);

        $posts = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();


        return $this->render('index', [
           'posts' => $posts,
           'pages' => $pages,
        ]);
    }

    public function actionPage($alias){
        $post = Posts::find()->where(['alias' => Html::encode($alias)])->one();
        $post->views = $post->views + 1;
        $post->save();

        $cookies = Yii::$app->request->cookies;
        $uniqid = $cookies->get('uniqid')->value;
        $rating = PostRating::find()->where(['post_id' => $post->id, 'kuki' => $uniqid])->one();

        return $this->render('page', [
           'post' => $post,
           'rating' => $rating,
        ]);
    }

    public function actionRate()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $card_id = (int) $post['card_id'];
            $value = (float) $post['value'];

            $cookies = Yii::$app->request->cookies;
            $uniqid = $cookies->get('uniqid')->value;
            $rating = PostRating::find()->where(['post_id' => $card_id, 'kuki' => $uniqid])->one();
            if ($rating) {
                $rating->value = $value;
                return $rating->save();
            } else {
                $rating = new PostRating();
                $rating->post_id = $card_id;
                $rating->value = $value;
                $rating->kuki = $uniqid;
                return $rating->save();
            }
        }
    }

}