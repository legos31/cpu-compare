<?php

namespace app\modules\admin\models;

use app\models\Brand;
use Yii;

/**
 * This is the model class for table "gpu".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $category_id
 * @property int|null $brand_id
 * @property string|null $image
 * @property string|null $image_mini
 * @property string|null $alias
 * @property string|null $description
 * @property int|null $date
 * @property int|null $last_update
 * @property string|null $release_date
 * @property string|null $hertz
 * @property string|null $type
 * @property string|null $score
 * @property string|null $price
 * @property string|null $memory_size
 * @property string|null $memory_type
 * @property float|null $rating
 * @property int|null $status
 * @property string|null $source_url
 * @property int|null $counter
 * @property int|null $top
 * @property int|null $best_processor
 * @property int|null $best_score
 * @property int|null $best_price
 * @property int|null $popular
 * @property int|null $is_new
 * @property int|null $last_view
 * @property int|null $recomend
 */
class Gpu extends \yii\db\ActiveRecord
{
    public $file;
    public $file_mini;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gpu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'brand_id', 'date', 'last_update', 'status', 'recomend'], 'integer'],
            [['top', 'best_processor', 'best_score', 'best_price', 'popular'], 'safe'],
            [['description'], 'string'],
            [['rating'], 'number'],
            [['date', 'last_update'], 'default', 'value' => time()],
            [['category_id'], 'default', 'value' => 2],
            [['status'], 'default', 'value' => 1],
            [['name', 'image', 'image_mini', 'alias', 'release_date', 'hertz', 'type', 'score', 'price', 'memory_size', 'memory_type', 'source_url'], 'string', 'max' => 255],
            [['name', 'brand_id', 'release_date', 'hertz', 'type', 'score', 'memory_size', 'memory_type'], 'required'],
            [['file', 'file_mini'], 'file', 'extensions' => 'png, jpg']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'category_id' => 'Категория',
            'brand_id' => 'Бренд',
            'image' => 'Картинка',
            'file' => 'Картинка',
            'file_mini' => 'Картинка мини',
            'image_mini' => 'Картинка мини',
            'alias' => 'Alias',
            'description' => 'Описание',
            'date' => 'Дата',
            'last_update' => 'Последное обновление',
            'release_date' => 'Дата выхода',
            'hertz' => 'Тактовая частота',
            'type' => 'Тип',
            'score' => 'Производительность',
            'price' => 'Цена',
            'memory_size' => 'Объем памяти',
            'memory_type' => 'Тип памяти',
            'rating' => 'Оценка',
            'status' => 'Статус',
            'source_url' => 'Источник',
            'counter' => 'Количество просмотров',
            'top' => 'Топ 10',
            'best_processor' => 'Лучший интегрированный процессор',
            'best_score' => 'Лучшая общая производительность',
            'best_price' => 'Лучшие процессоры по соотношению цена-качество',
            'popular' => 'Популярные процессоры',
        ];
    }

    public function beforeSave($insert)
    {
        $this->alias = createAlias($this->name);
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

    public function upload()
    {
        if ($this->validate()) {
            if (file_exists($this->image)  && !empty($this->file)) {
                unlink($this->image);
            }
            if (file_exists($this->image_mini)  && !empty($this->file_mini)) {
                unlink($this->image_mini);
            }

            if ($this->file) {
                $path = 'images/uploads/gpu/' . $this->alias . '.' . $this->file->extension;
                $this->file->saveAs($path);
                $this->file = null;
                $this->image = '/' . $path;
            }

            if ($this->file_mini) {
                $path2 = 'images/uploads/gpu/' . $this->alias . '_mini.' . $this->file_mini->extension;
                $this->file_mini->saveAs($path2);
                $this->image_mini = '/' . $path2;
                $this->file_mini = null;
            }

            $this->save();
        } else {
            return false;
        }
    }

    public function getBrand()
    {
        return $this->hasOne(Brand::className(), ['id' => 'brand_id']);
    }

    public function getBenchmarks()
    {
        return $this->hasMany(Benchmark::className(), ['id' => 'benchmark_id'])
            ->viaTable('gpu_benchmark', ['gpu_id' => 'id']);
    }
    public function getBenchmarkItems($id)
    {
        $it = GpuBenchmark::find()->where(['gpu_id' => $this->id, 'benchmark_id' => $id])->select('id')->column();
        $items = GpuBenchmarkItems::findAll(['gpu_benchmark_id' => $it]);
        return $items;
    }


    public function getSpecifications()
    {
        return $this->hasMany(Specification::className(), ['id' => 'specification_id'])
            ->viaTable('gpu_specification', ['gpu_id' => 'id']);
    }

    public function getSpecItems($spec_id)
    {
        $it = GpuSpecification::find()->where(['gpu_id' => $this->id, 'specification_id' => $spec_id])->select('id')->column();
        $items = GpuSpecificationItems::findAll(['gpu_specification_id' => $it]);
        return $items;
    }

    public function saveSpecifications()
    {
        $data = Yii::$app->request->post('Specification');
        if ($data) {
            $gp_specs = GpuSpecification::find()->where(['gpu_id' => $this->id])->all();
            foreach ($gp_specs as $gp_spec) {
                GpuSpecificationItems::deleteAll(['gpu_specification_id' => $gp_spec->id]);
                $gp_spec->delete();
            }
            foreach ($data as $item) {
                $gs = new GpuSpecification();
                $gs->gpu_id = $this->id;
                $gs->specification_id = $item['label'];
                if ($gs->save()) {
                    foreach ($item['group'] as $specification) {
                        $gsi = new GpuSpecificationItems();
                        $gsi->name = $specification['label'];
                        $gsi->value = $specification['value'];
                        $gsi->gpu_specification_id = $gs->id;
                        $gsi->save();
                    }
                }
            }
        }
    }

    public function saveBenchmark()
    {
        $data = Yii::$app->request->post('Benchmark');
        if ($data) {
            $gp_specs = GpuBenchmark::find()->where(['gpu_id' => $this->id])->all();
            foreach ($gp_specs as $gp_spec) {
                GpuBenchmarkItems::deleteAll(['gpu_benchmark_id' => $gp_spec->id]);
                $gp_spec->delete();
            }
            foreach ($data as $item) {
                $gs = new GpuBenchmark();
                $gs->gpu_id = $this->id;
                $gs->benchmark_id = $item['label'];
                if ($gs->save()) {
                    if ($item['group']) {
                        foreach ($item['group'] as $specification) {
                            $gsi = new GpuBenchmarkItems();
                            $gsi->name = $specification['label'];
                            $gsi->value = $specification['value'];
                            $gsi->gpu_benchmark_id = $gs->id;
                            $gsi->save();
                        }
                    }
                }
            }
        }
    }
}
