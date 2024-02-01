<?php

namespace app\modules\admin\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\Card;

/**
 * CardSearch represents the model behind the search form of `app\modules\admin\models\Card`.
 */
class CardSearch extends Card
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'date', 'last_update', 'brand_id', 'status'], 'integer'],
            [['top', 'best_processor', 'best_score', 'best_price', 'popular'], 'safe'],
            [['name', 'alias', 'image', 'description', 'release_date', 'hertz', 'type', 'socket', 'score', 'cores', 'turbo_hertz', 'watt', 'l3_cache', 'source_url', 'image_mini', 'price', 'pt_dollar', 'category'], 'safe'],
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
        $query = Card::find();

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
            'date' => $this->date,
            'last_update' => $this->last_update,
            'brand_id' => $this->brand_id,
            'status' => $this->status,
            'rating' => $this->rating,
            'top' => $this->top,
            'best_processor' => $this->best_processor,
            'best_score' => $this->best_score,
            'best_price' => $this->best_price,
            'popular' => $this->popular,
        ]);



        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'alias', $this->alias])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'release_date', $this->release_date])
            ->andFilterWhere(['like', 'hertz', $this->hertz])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'socket', $this->socket])
            ->andFilterWhere(['like', 'score', $this->score])
            ->andFilterWhere(['like', 'cores', $this->cores])
            ->andFilterWhere(['like', 'turbo_hertz', $this->turbo_hertz])
            ->andFilterWhere(['like', 'watt', $this->watt])
            ->andFilterWhere(['like', 'l3_cache', $this->l3_cache])
            ->andFilterWhere(['like', 'source_url', $this->source_url])
            ->andFilterWhere(['like', 'image_mini', $this->image_mini])
            ->andFilterWhere(['like', 'price', $this->price])
            ->andFilterWhere(['like', 'pt_dollar', $this->pt_dollar])
            ->andFilterWhere(['like', 'category', $this->category]);

        return $dataProvider;
    }
}
