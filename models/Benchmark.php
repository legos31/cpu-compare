<?php

namespace app\models;

use phpDocumentor\Reflection\DocBlock\Description;
use Yii;

/**
 * This is the model class for table "benchmark".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property string|null $url
 */
class Benchmark extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'benchmark';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
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
            'description' => 'Description',
            'url' => 'Url',
        ];
    }

    public static function addNew($key, $page)
    {
        $benchmark = self::find()->where(['name' => $key])->one();
        if (!$benchmark) {
            $page->find('.full_col>div, .full_col>h1, .full_col>h2, .full_col>a:last, .full_col>br')->remove();
            $benchmark = new self();
            $benchmark->name = $key;
            $benchmark->description = trim($page->find('.full_col')->text());
            $benchmark->save(false);
        }

        return $benchmark;
    }
}
