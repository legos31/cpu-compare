<?php

namespace app\models;


use DateTime;
use yii\base\Model;
use yii\helpers\Html;

class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;

    public function rules()
    {
        return [
            [['username', 'password', 'email'], 'required'],
            [['email'], 'email'],
            [['password'], 'string', 'length' => [6]],
            [['username'], 'unique', 'targetClass' => 'app\models\Users', 'targetAttribute' => 'username', 'message' => 'Ползователь таким именим уже сушествует. Введите другую почту'],
            [['email'], 'unique', 'targetClass' => 'app\models\Users', 'targetAttribute' => 'email', 'message' => 'Ползователь такой почтой  уже сушествует. Введите другую почту'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' =>  'Логин',
            'email' => 'Email',
            'password' =>  'Пароль'
        ];
    }


    public function signup()
    {
        if($this->validate())
        {
            $date = new DateTime();

            $user  = new Users();

            $user->username = Html::encode(trim($this->username));
            $user->email = Html::encode(trim($this->email));
            $user->password = password_hash($this->password, PASSWORD_DEFAULT);
            $user->created_at = $date->getTimestamp();
            $user->updated_at = $date->getTimestamp();
            $user->alias = uniqid('e');
            $user->status = 0;
            return $user->save();
        }
    }


}