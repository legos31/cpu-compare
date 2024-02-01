<?php

namespace app\components;

use app\models\CommentForm;
use app\models\Comments;
use app\models\CommentUsers;
use app\models\Compare;
use app\models\Gpu;
use app\models\Card;
use app\models\Posts;
use Yii;
use yii\base\Widget;
use yii\helpers\Html;

class CommentWidget extends Widget
{

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $controller = Yii::$app->controller->id;
        $action = Yii::$app->controller->action->id;

        $block = $controller;
        if($action == 'compare'){
            $block .= '_compare';
        }
        $card = null;
        $param = Yii::$app->request->get('alias') ?? Yii::$app->request->get('vs');
        $param = Html::encode($param);
        if($controller == 'cpu' && $action == 'index'){
            $card = Card::find()->where(['alias' => $param])->one();
        } else if($controller == 'gpu' && $action == 'index'){
            $card = Gpu::find()->where(['alias' => $param])->one();
        } else if($action == 'compare'){
            $card = Compare::find()->where(['like', 'url', $param])->one();
        } else if($controller == 'posts'){
            $card = Posts::find()->where(['alias' => $param])->one();
        }

        $cookies = Yii::$app->request->cookies;
        $uniqid = $cookies->getValue('uniqid');
        if ($uniqid) {
            $user = CommentUsers::find()->where(['kuki' => $uniqid])->one();
        } else {
            $user = null;
        }

        

        $comment = new CommentForm();
        $comment->blok = $block;
        $comment->blok_id = $card->id;
        if ($user) {
            $comment->username = $user->name;
            $comment->email = $user->email;
        }

        $comments = Comments::find()->where(['blok' => $block, 'blok_id' => $card->id, 'parent_id' => null])->all();
        $comment_count = Comments::find()->where(['blok' => $block, 'blok_id' => $card->id])->count();

        return $this->render('comment', [
            'comment' => $comment,
            'comments' => $comments,
            'comment_count' => $comment_count,
        ]);
    }
}
