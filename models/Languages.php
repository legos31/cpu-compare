<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "languages".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $code
 * @property string|null $icon
 * @property string|null $url
 * @property int|null $default_lang
 * @property string|null $local
 */
class Languages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'languages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['default_lang'], 'integer'],
            [['name', 'icon', 'url', 'local'], 'string', 'max' => 255],
            [['code'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'code' => 'Code',
            'icon' => 'Icon',
            'url' => 'Url',
            'default_lang' => 'Default Lang',
            'local' => 'Local',
        ];
    }

    //Переменная, для хранения текущего объекта языка
    static $current = null;

    //Получение текущего объекта языка
    static function getCurrent()
    {
        if( self::$current === null ){
            self::$current = self::getDefaultLang();
        }
        return self::$current;
    }

    //Установка текущего объекта языка и локаль пользователя
    static function setCurrent($url = null)
    {
        $language = self::getLangByUrl($url);
        self::$current = ($language === null) ? self::getDefaultLang() : $language;
        Yii::$app->language = self::$current->url;
    }

    //Получения объекта языка по умолчанию
    static function getDefaultLang()
    {
        return Languages::find()->where('`default_lang` = :default_lang', [':default_lang' => 1])->one();
    }

    //Получения объекта языка по буквенному идентификатору
    static function getLangByUrl($url = null)
    {
        if ($url === null) {
            return null;
        } else {
            $language = Languages::find()->where('url = :url', [':url' => $url])->one();
            if ( $language === null ) {
                return null;
            }else{
                return $language;
            }
        }
    }
}
