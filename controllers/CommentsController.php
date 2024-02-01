<?php


namespace app\controllers;

use app\models\CommentForm;
use app\models\Comments;
use app\models\CommentUsers;
use app\models\Likedislike;
use Yii;
use yii\web\MethodNotAllowedHttpException;
use yii\web\Response;

class CommentsController extends MainController
{
    public function actionCreate()
    {
        if (Yii::$app->request->isPost) {

            $post = Yii::$app->request->post();
            $comment = new CommentForm();
            if ($comment->load($post) && $comment->validate()) {
                $cookies = Yii::$app->request->cookies;
                $uniqid = $cookies->get('uniqid')->value;
                $user = CommentUsers::find()->where(['kuki' => $uniqid, 'email' => $comment->email])->one();
                if (!$user) {
                    $user = new CommentUsers();
                    $user->kuki = $uniqid;
                    $user->name = $comment->username;
                    $user->email = $comment->email;
                    $user->save();
                }

                $model = new Comments();
                $model->addNew($comment, $user);

                return $this->redirect(Yii::$app->request->referrer);
            }
        } else {
            throw new MethodNotAllowedHttpException('Method not allowed');
        }
    }

    public function actionLike($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $cookies = Yii::$app->request->cookies;
        $uniqid = $cookies->get('uniqid')->value;
        $comment = Comments::findOne((int) $id);
        if (!$comment) return false;

        $lk = Likedislike::find()->where(['comment_id' => $comment->id, 'kuki' => $uniqid])->one();
        if(!$lk){
            $lk = new Likedislike();
            $lk->comment_id = $comment->id;
            $lk->kuki = $uniqid;
            $lk->like = 1;
            return $lk->save();
        }
        $lk->like = 1;
        return false;

    }

    public function actionDislike($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $cookies = Yii::$app->request->cookies;
        $uniqid = $cookies->get('uniqid')->value;
        $comment = Comments::findOne((int) $id);
        if (!$comment) return false;

        $lk = Likedislike::find()->where(['comment_id' => $comment->id, 'kuki' => $uniqid])->one();
        if(!$lk){
            $lk = new Likedislike();
            $lk->comment_id = $comment->id;
            $lk->kuki = $uniqid;
            $lk->like = 1;
            return $lk->save();
        }
        $lk->like = 0;
        return false;
    }
}
