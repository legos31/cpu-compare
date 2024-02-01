<?php

namespace app\modules\admin\models;

use DateTime;
use Yii;
use yii\helpers\Html;
use yii\web\UploadedFile;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $username
 * @property string $auth_key
 * @property string $password
 * @property string $password_reset
 * @property string $email
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property string $alias
 * @property string $code
 * @property string $img
 */
class Users extends \yii\db\ActiveRecord
{
    public $file;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }


    public static function getRole($role)
    {
        if ($role == 0) {
            $role = '<span class=\'label label-success\'>Пользователь</span>';
        } elseif ($role == 1) {
            $role = '<span class=\'label label-primary\'>Админ</span>';
        } else {
            $role = '<span class=\'label label-info\'>Модератор</span>';
        }
        return $role;
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password', 'email'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'password', 'password_reset', 'email', 'alias', 'code', 'img'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['email'], 'email'],
            [['file'], 'file', 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ИД'),
            'username' => Yii::t('app', 'Логин'),
            'auth_key' => Yii::t('app', 'Авторизационный ключ'),
            'password' => Yii::t('app', 'Пароль'),
            'password_reset' => Yii::t('app', 'Старый пароль'),
            'email' => Yii::t('app', 'Email'),
            'status' => Yii::t('app', 'Роль'),
            'created_at' => Yii::t('app', 'Добавлено'),
            'updated_at' => Yii::t('app', 'Обновлено'),
            'alias' => Yii::t('app', 'Алиас'),
            'code' => Yii::t('app', 'Код'),
            'img' => Yii::t('app', 'Картинка'),
        ];
    }

    public function upload()
    {
        if ($this->validate() && $this->file) {
            if (file_exists($this->img)  && !empty($this->file)) {
                unlink($this->img);
            }

            $path = 'img/uploads/users/' . uniqid(md5($this->file->baseName)) . '.' . $this->file->extension;
            $this->file->saveAs($path);
            $this->img = $path;
            $this->save(false);
            return true;
        } else {
            return false;
        }
    }

    public function addUser($model)
    {
        $date = new DateTime();
        $this->username = Html::encode($model->username);
        $this->email = Html::encode($model->email);
        $this->password = password_hash($model->password, PASSWORD_DEFAULT);
        $this->alias = uniqid('e');
        $this->created_at = $date->getTimestamp();
        $this->updated_at = $date->getTimestamp();
        $this->save(false);
        if (Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstance($model, 'file');
            $model->upload();
        }
        return true;
    }

    public function upUser($model)
    {
        $date = new DateTime();
        if ($this->validate()) {
            $this->username = Html::encode(trim($model->username));
            $this->email = Html::encode(trim($model->email));
            $this->status = Html::encode(trim($model->status));
            if ($model->getOldAttribute('password') != $model->password) {
                $this->password = password_hash($model->password, PASSWORD_DEFAULT);
            }
            $this->updated_at = $date->getTimestamp();
            $this->save();
        }


        if (Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstance($model, 'file');
            $model->upload();
        }
        return true;
    }
}
