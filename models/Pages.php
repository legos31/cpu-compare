<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pages".
 *
 * @property int $id
 * @property string|null $name
 */
class Pages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
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
        ];
    }

    public function getMeta(){
        //$lang_code = \Yii::$app->request->headers['x-gt-lang'] ?? 'en';
        $lang_code = Yii::$app->language ?? 'en';
        $language = \app\modules\admin\models\Languages::find()->where(['code' => $lang_code])->one();
        $meta = \app\modules\admin\models\PageLanguage::find()->where(['page_id' => $this->id, 'language_id' => $language->id])->one();
        return [
            'title' => $meta->title ?? '',
            'description' => $meta->description ?? '',
        ];
    }
}
