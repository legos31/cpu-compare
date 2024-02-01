<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "parsed_cpus".
 *
 * @property int $id
 * @property string $name
 * @property string $url
 * @property int $date
 * @property int $is_new
 */
class ParsedCpus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'parsed_cpus';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'url', 'date', 'is_new'], 'required'],
            [['date', 'is_new'], 'integer'],
            [['name', 'url'], 'string', 'max' => 255],
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
            'url' => 'Url',
            'date' => 'Date',
            'is_new' => 'Is New',
        ];
    }

    public static function addNew($name, $url) {
        $check = self::find()->where(['name' => $name])->exists();
        if(!$check){
            $cpu = new self();
            $cpu->name = $name;
            $cpu->url = $url;
            $cpu->date = time();
            $cpu->is_new = 1;
            $cpu->save();
        }
    }

    public static function parsed($cpu) {
        $model = self::findOne($cpu->id);
        $model->is_new = 0;
        $model->save(false);
    }
}
