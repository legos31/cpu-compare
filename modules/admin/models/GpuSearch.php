<?php

namespace app\modules\admin\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\Gpu;

/**
 * GpuSearch represents the model behind the search form of `app\modules\admin\models\Gpu`.
 */
class GpuSearch extends Gpu
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'brand_id', 'date', 'last_update', 'status'], 'integer'],
            [['name', 'image', 'image_mini', 'alias', 'description', 'release_date', 'hertz', 'type', 'score', 'price', 'memory_size', 'memory_type', 'source_url'], 'safe'],
            [['rating'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Gpu::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'category_id' => $this->category_id,
            'brand_id' => $this->brand_id,
            'date' => $this->date,
            'last_update' => $this->last_update,
            'rating' => $this->rating,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'image_mini', $this->image_mini])
            ->andFilterWhere(['like', 'alias', $this->alias])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'release_date', $this->release_date])
            ->andFilterWhere(['like', 'hertz', $this->hertz])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'score', $this->score])
            ->andFilterWhere(['like', 'price', $this->price])
            ->andFilterWhere(['like', 'memory_size', $this->memory_size])
            ->andFilterWhere(['like', 'memory_type', $this->memory_type])
            ->andFilterWhere(['like', 'source_url', $this->source_url]);

        return $dataProvider;
    }
}
