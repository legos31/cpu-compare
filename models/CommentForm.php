<?php

namespace app\models;

use yii\base\Model;

class CommentForm extends Model
{
    public $username;
    public $email;
    public $message;
    public $blok;
    public $blok_id;
    public $parent_id;
    public $subscribe;

    public function rules()
    {
        return [
            [['username', 'email', 'message'], 'required'],
            [['blok', 'blok_id', 'parent_id'], 'safe'],
            [['email'], 'email']
        ];
    }
}
