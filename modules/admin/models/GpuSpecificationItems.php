<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "gpu_specification_items".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $value
 * @property int|null $gpu_specification_id
 */
class GpuSpecificationItems extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gpu_specification_items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['gpu_specification_id'], 'integer'],
            [['name', 'value'], 'string', 'max' => 255],
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
            'value' => 'Value',
            'gpu_specification_id' => 'Gpu Specification ID',
        ];
    }
}
