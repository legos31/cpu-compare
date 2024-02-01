<?php

namespace app\modules\admin\models;

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
}
