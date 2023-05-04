<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Raspisanie;

/**
 * RaspisanieSearch represents the model behind the search form of `backend\models\Raspisanie`.
 */
class RaspisanieSearch extends Raspisanie
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'grid', 'cid', 'sort'], 'integer'],
            [['name', 'date', 'time', 'desc'], 'safe'],
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
        $query = Raspisanie::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => array(
                'pageSize' => 10,
            )
        ]);

        $this->load($params);

        if ( $this->time <> '' ) {
            $this->time = date('Y-m-d H:i:s', strtotime($this->time));
        }

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'grid' => $this->grid,
            'cid' => $this->cid,
            'sort' => $this->sort,
            'date' => $this->date,
            'time' => $this->time,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'desc', $this->desc])
            /*->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'keywords', $this->keywords])*/;

        return $dataProvider;
    }
}
