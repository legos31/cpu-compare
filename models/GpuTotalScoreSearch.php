<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\GpuTotalScore;

/**
 * GpuTotalScoreSearch represents the model behind the search form of `app\models\GpuTotalScore`.
 */
class GpuTotalScoreSearch extends GpuTotalScore
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'total_score', 'position'], 'integer'],
            [['gpu_id', 'brand_id'], 'safe'],
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
        $query = GpuTotalScore::find();

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
            'total_score' => $this->total_score,
            'position' => $this->position,
        ]);

        $query->andFilterWhere(['like', 'gpu_id', $this->gpu_id])
            ->andFilterWhere(['like', 'brand_id', $this->brand_id]);

        return $dataProvider;
    }
}
