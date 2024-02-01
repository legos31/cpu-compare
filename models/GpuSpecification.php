<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gpu_specification".
 *
 * @property int $id
 * @property int|null $gpu_id
 * @property int|null $specification_id
 */
class GpuSpecification extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gpu_specification';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['gpu_id', 'specification_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'gpu_id' => 'Gpu ID',
            'specification_id' => 'Specification ID',
        ];
    }

    public function getSpecification()
    {
        return $this->hasOne(Specification::className(), ['id' => 'specification_id']);
    }

    public function getItems()
    {
        return $this->hasMany(GpuSpecificationItems::className(), ['gpu_specification_id' => 'id']);
    }

    public static function addNew($card_id, $specification_id) {
        $model = new self();
        $model->gpu_id = $card_id;
        $model->specification_id = $specification_id;
        $model->save();
        return $model;
    }
}
