<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CardTotalScore;

/**
 * CpuTotalScoreSearch represents the model behind the search form of `app\models\CardTotalScore`.
 */
class CpuTotalScoreSearch extends CardTotalScore
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'mobile', 'position'], 'integer'],
            [['cpu_id', 'brand_id', 'total_score'], 'safe'],
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
        $query = CardTotalScore::find();

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
            'mobile' => $this->mobile,
            'position' => $this->position,
        ]);

        $query->andFilterWhere(['like', 'cpu_id', $this->cpu_id])
            ->andFilterWhere(['like', 'brand_id', $this->brand_id])
            ->andFilterWhere(['like', 'total_score', $this->total_score]);

        return $dataProvider;
    }
}
