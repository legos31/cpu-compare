<?php
/**
 * Created by PhpStorm.
 * User: Umar
 * Date: 07.09.2018
 * Time: 14:33
 */

namespace app\models;


use yii\db\ActiveRecord;
use yii\helpers\Html;
use yii\web\IdentityInterface;

class Users extends ActiveRecord implements IdentityInterface
{

    public static function tableName()
    {
        return 'users';
    }

    public function rules()
    {
        return [
            [['auth_key', 'password_reset', 'status', 'created_at', 'updated_at'], 'safe'],
            [['username', 'password', 'email'], 'required'],
            [['email'], 'email']
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Логин',
            'password' => 'Пароль',
            'email' => 'Email',
            'auth_key' => 'Авторизационный ключ',
            'password_reset' => 'Сброшенный пароль',
            'status' => 'Статус',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
        ];
    }

    public function getId()
    {
        return $this->id;
    }


    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }


    public static function findByUsername($username)
    {
        return Users::find()->where(['username' => Html::encode($username)])->one();
    }


    public function validatePassword($password)
    {
        return password_verify($password, $this->password) ? true : false;

    }

    public function validateCode($code)
    {
        return password_verify($code, $this->code) ? true : false;

    }

    public static function findIdentity($id)
    {
        return Users::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO: Implement findIdentityByAccessToken() method.
    }

    public function generateAuthKey()
    {
        $this->auth_key = \Yii::$app->security->generateRandomString();
    }

}