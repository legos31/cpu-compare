<?php

namespace app\models;

use app\models\Category;
use Yii;

/**
 * This is the model class for table "compare".
 *
 * @property int $id
 * @property int|null $card_1
 * @property int|null $card_2
 * @property int|null $category_id
 * @property int|null $date
 * @property int|null $counter
 * @property string|null $url
 */
class Compare extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'compare';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['card_1', 'card_2', 'category_id', 'date', 'counter'], 'integer'],
            [['url'], 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'card_1' => 'Card 1',
            'card_2' => 'Card 2',
            'category_id' => 'Category ID',
            'date' => 'Date',
        ];
    }

    public function getCard1()
    {
        if ($this->category_id == 1) {
            return $this->hasOne(Card::className(), ['id' => 'card_1']);
        } else {
            return $this->hasOne(Gpu::className(), ['id' => 'card_1']);
        }
    }

    public function getCard2()
    {
        if ($this->category_id == 1) {
            return $this->hasOne(Card::className(), ['id' => 'card_2']);
        } else {
            return $this->hasOne(Gpu::className(), ['id' => 'card_2']);
        }
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    public static function cardBenchmark($card1, $card2)
    {

        $card1_benchmarks = CardBenchmark::getDb()->cache(function () use ($card1) {
            return CardBenchmark::find()->where(['card_id' => $card1->id])->asArray()->select('benchmark_id')->column();
        },86400);
        //$card1_benchmarks = CardBenchmark::find()->where(['card_id' => $card1->id])->asArray()->select('benchmark_id')->column();
        
        $card2_benchmarks = CardBenchmark::getDb()->cache(function () use ($card2) {
            return CardBenchmark::find()->where(['card_id' => $card2->id])->asArray()->select('benchmark_id')->column();
        },86400);
        //$card2_benchmarks = CardBenchmark::find()->where(['card_id' => $card2->id])->asArray()->select('benchmark_id')->column();
        
        $benchmarks = array_intersect($card1_benchmarks, $card2_benchmarks);
        

        $cbi1 = CardBenchmark::getDb()->cache(function () use ($benchmarks, $card1) {
            return CardBenchmark::find()->where(['card_id' => $card1->id, 'benchmark_id' => $benchmarks])->select('id')->column();
        },86400);
        //$cbi1 = CardBenchmark::find()->where(['card_id' => $card1->id, 'benchmark_id' => $benchmarks])->select('id')->column();

        $cbi2 = CardBenchmark::getDb()->cache(function () use ($benchmarks, $card2) {
            return CardBenchmark::find()->where(['card_id' => $card2->id, 'benchmark_id' => $benchmarks])->select('id')->column();
        },86400);
        //$cbi2 = CardBenchmark::find()->where(['card_id' => $card2->id, 'benchmark_id' => $benchmarks])->select('id')->column();

        $items1 = CardBenchmarkItems::getDb()->cache(function () use ($cbi1, $card1) {
            return CardBenchmarkItems::find()->where(['card_benchmark_id' => $cbi1, 'name' => $card1->name])->groupBy('card_benchmark_id')->all();
        },86400);
        //$items1 = CardBenchmarkItems::find()->where(['card_benchmark_id' => $cbi1, 'name' => $card1->name])->groupBy('card_benchmark_id')->all();

        $items2 = CardBenchmarkItems::getDb()->cache(function () use ($cbi2, $card2) {
            return CardBenchmarkItems::find()->where(['card_benchmark_id' => $cbi2, 'name' => $card2->name])->groupBy('card_benchmark_id')->all();
        },86400);
        //$items2 = CardBenchmarkItems::find()->where(['card_benchmark_id' => $cbi2, 'name' => $card2->name])->groupBy('card_benchmark_id')->all();

        $data = [];
        foreach ($items1 as $key => $item) {
            $data[$item->benchmark->name]['description'] = $item->benchmark->description;
            $data[$item->benchmark->name]['items'][] = [
                'image' => $card1->image,
                'name' => $item->name,
                'value' => $item->value,
                'style' => $item->style,
            ];
            $data[$item->benchmark->name]['items'][] = [
                'image' => $card2->image,
                'name' => isset($items2[$key]) ? $items2[$key]->name : '',
                'value' => isset($items2[$key]) ? $items2[$key]->value : '',
                'style' => isset($items2[$key]) ? $items2[$key]->style : '',
            ];
        }
        return $data;

    }

    public static function cardSpecs($card1, $card2)
    {
        $card1_specs = CardSpecification::getDb()->cache(function () use ($card1) {
            return CardSpecification::find()->where(['card_id' => $card1->id])->asArray()->select('specification_id')->column();
        },86400);
        //$card1_specs = CardSpecification::find()->where(['card_id' => $card1->id])->asArray()->select('specification_id')->column();

        $card2_specs = CardSpecification::getDb()->cache(function () use ($card2) {
            return CardSpecification::find()->where(['card_id' => $card2->id])->asArray()->select('specification_id')->column();
        },86400);
        //$card2_specs = CardSpecification::find()->where(['card_id' => $card2->id])->asArray()->select('specification_id')->column();

        $specifications = array_intersect($card1_specs, $card2_specs);

        $cc1 = CardSpecification::getDb()->cache(function () use ($card1, $specifications) {
            return CardSpecification::find()->where(['card_id' => $card1->id, 'specification_id' => $specifications])->select('id')->column();
        },86400);
        //$cc1 = CardSpecification::find()->where(['card_id' => $card1->id, 'specification_id' => $specifications])->select('id')->column();
        
        $cc2 = CardSpecification::getDb()->cache(function () use ($card2, $specifications) {
            return CardSpecification::find()->where(['card_id' => $card2->id, 'specification_id' => $specifications])->select('id')->column();
        },86400);
        //$cc2 = CardSpecification::find()->where(['card_id' => $card2->id, 'specification_id' => $specifications])->select('id')->column();

        $items1 = CardSpecificationItems::getDb()->cache(function () use ($cc1) {
            return CardSpecificationItems::find()->where(['card_specification_id' => $cc1])->all();
        },86400);
        //$items1 = CardSpecificationItems::find()->where(['card_specification_id' => $cc1])->all();

        $items2 = CardSpecificationItems::getDb()->cache(function () use ($cc2) {
            return CardSpecificationItems::find()->where(['card_specification_id' => $cc2])->all();
        },86400);
        //$items2 = CardSpecificationItems::find()->where(['card_specification_id' => $cc2])->all();
//var_dump($items1);die;
        $data = [];
        foreach ($items1 as $key => $item) {
            $data[$item->specification->name][$item->name][0] = $item->value;
        }

        foreach ($items2 as $key => $item) {
            $data[$item->specification->name][$item->name][1] = $item->value;
        }
        return $data;
    }

    public static function gpuBenchmark($card1, $card2)
    {

        $card1_benchmarks = GpuBenchmark::getDb()->cache(function () use ($card1) {
            return GpuBenchmark::find()->where(['gpu_id' => $card1->id])->andWhere(['not in', 'benchmark_id', [132]])->asArray()->select('benchmark_id')->column();
        },86400);
        //$card1_benchmarks = GpuBenchmark::find()->where(['gpu_id' => $card1->id])->andWhere(['not in', 'benchmark_id', [132]])->asArray()->select('benchmark_id')->column();

        $card2_benchmarks = GpuBenchmark::getDb()->cache(function () use ($card2) {
            return GpuBenchmark::find()->where(['gpu_id' => $card2->id])->andWhere(['not in', 'benchmark_id', [132]])->asArray()->select('benchmark_id')->column();
        },86400);
        //$card2_benchmarks = GpuBenchmark::find()->where(['gpu_id' => $card2->id])->andWhere(['not in', 'benchmark_id', [132]])->asArray()->select('benchmark_id')->column();

        $benchmarks = array_intersect($card1_benchmarks, $card2_benchmarks);

        $cbi1 = GpuBenchmark::getDb()->cache(function () use ($card1, $benchmarks) {
            return GpuBenchmark::find()->where(['gpu_id' => $card1->id, 'benchmark_id' => $benchmarks])->select('id')->column();
        },86400);
        //$cbi1 = GpuBenchmark::find()->where(['gpu_id' => $card1->id, 'benchmark_id' => $benchmarks])->select('id')->column();

        $cbi2 = GpuBenchmark::getDb()->cache(function () use ($card2, $benchmarks) {
            return GpuBenchmark::find()->where(['gpu_id' => $card2->id, 'benchmark_id' => $benchmarks])->select('id')->column();
        },86400);
        //$cbi2 = GpuBenchmark::find()->where(['gpu_id' => $card2->id, 'benchmark_id' => $benchmarks])->select('id')->column();

        $items1 = GpuBenchmarkItems::getDb()->cache(function () use ($cbi1, $card1) {
            return GpuBenchmarkItems::find()->where(['gpu_benchmark_id' => $cbi1, 'name' => $card1->name])->groupBy('gpu_benchmark_id')->all();
        },86400);
        //$items1 = GpuBenchmarkItems::find()->where(['gpu_benchmark_id' => $cbi1, 'name' => $card1->name])->groupBy('gpu_benchmark_id')->all();
        
        $items2 = GpuBenchmarkItems::getDb()->cache(function () use ($cbi2, $card2) {
            return GpuBenchmarkItems::find()->where(['gpu_benchmark_id' => $cbi2, 'name' => $card2->name])->groupBy('gpu_benchmark_id')->all();
        },86400);
        //$items2 = GpuBenchmarkItems::find()->where(['gpu_benchmark_id' => $cbi2, 'name' => $card2->name])->groupBy('gpu_benchmark_id')->all();

        $data = [];
        foreach ($items1 as $key => $item) {
            $data[$item->benchmark->name]['description'] = $item->benchmark->description;
            $data[$item->benchmark->name]['items'][] = [
                'image' => $card1->image,
                'name' => $item->name,
                'value' => $item->value,
                'style' => $item->style,
            ];
            $data[$item->benchmark->name]['items'][] = [
                'image' => $card2->image,
               
                    'name' => isset($items2[$key]) ? $items2[$key]->name : '',
                    'value' => isset($items2[$key]) ? $items2[$key]->value : '',
                    'style' => isset($items2[$key]) ? $items2[$key]->style : '',
              
            ];
        }
        return $data;

    }

    public static function gpuSpecs($card1, $card2)
    {
        $card1_specs = GpuSpecification::getDb()->cache(function () use ($card1) {
            return GpuSpecification::find()->where(['gpu_id' => $card1->id])->asArray()->select('specification_id')->column();
        },86400);
        //$card1_specs = GpuSpecification::find()->where(['gpu_id' => $card1->id])->asArray()->select('specification_id')->column();

        $card2_specs = GpuSpecification::getDb()->cache(function () use ($card2) {
            return GpuSpecification::find()->where(['gpu_id' => $card2->id])->asArray()->select('specification_id')->column();
        },86400);
        //$card2_specs = GpuSpecification::find()->where(['gpu_id' => $card2->id])->asArray()->select('specification_id')->column();

        $specifications = array_intersect($card1_specs, $card2_specs);

        $cc1 = GpuSpecification::getDb()->cache(function () use ($card1, $specifications) {
            return GpuSpecification::find()->where(['gpu_id' => $card1->id, 'specification_id' => $specifications])->select('id')->column();
        },86400);
        //$cc1 = GpuSpecification::find()->where(['gpu_id' => $card1->id, 'specification_id' => $specifications])->select('id')->column();

        $cc2 = GpuSpecification::getDb()->cache(function () use ($card2, $specifications) {
            return GpuSpecification::find()->where(['gpu_id' => $card2->id, 'specification_id' => $specifications])->select('id')->column();
        },86400);
        //$cc2 = GpuSpecification::find()->where(['gpu_id' => $card2->id, 'specification_id' => $specifications])->select('id')->column();

        $items1 = GpuSpecificationItems::getDb()->cache(function () use ($cc1) {
            return GpuSpecificationItems::find()->where(['gpu_specification_id' => $cc1])->all();
        },86400);
        //$items1 = GpuSpecificationItems::find()->where(['gpu_specification_id' => $cc1])->all();

        $items2 = GpuSpecificationItems::getDb()->cache(function () use ($cc2) {
            return GpuSpecificationItems::find()->where(['gpu_specification_id' => $cc2])->all();
        },86400);
        //$items2 = GpuSpecificationItems::find()->where(['gpu_specification_id' => $cc2])->all();

        $data = [];
        foreach ($items1 as $key => $item) {
            $data[$item->specification->name][$item->name][0] = $item->value;
        }

        foreach ($items2 as $key => $item) {
            $data[$item->specification->name][$item->name][1] = $item->value;
        }
        return $data;
    }

    public function getMeta(){
        //$lang_code = \Yii::$app->request->headers['x-gt-lang'] ?? 'en';
        $lang_code = Yii::$app->language ?? 'en';
        $language = \app\modules\admin\models\Languages::find()->where(['code' => $lang_code])->one();
        $meta = \app\modules\admin\models\PageLanguage::find()->where(['page_id' => ($this->category_id == 1 ? 3 : 5 ), 'language_id' => $language->id])->one();
        return [
            'title' => $this->replace($meta->title ?? ''),
            'description' => $this->replace($meta->description ?? ''),
        ];
    }

    public function replace($str){
        $str = str_replace('{{card1_name}}', $this->card1->name, $str);
        $str = str_replace('{{card2_name}}', $this->card2->name, $str);
        return $str;
    }
}
