<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "specification".
 *
 * @property int $id
 * @property string|null $name
 */
class Specification extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'specification';
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

    public static function addNew($name){
        $model = Specification::find()->where(['name' => $name])->one();
        if($name && !$model){
            $model = new self();
            $model->name = $name;
            $model->save(false);
        }
        return $model;
    }
}
