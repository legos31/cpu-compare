<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "limits".
 *
 * @property int $id
 * @property string|null $ip
 * @property int|null $allowance
 * @property int|null $timestamp
 */
class Limits extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'limits';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['allowance', 'timestamp'], 'integer'],
            [['ip'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ip' => 'Ip',
            'allowance' => 'Allowance',
            'timestamp' => 'Timestamp',
        ];
    }
}
