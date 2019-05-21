<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Agents;

/**
 * AgentsSearch represents the model behind the search form about `backend\models\Agents`.
 */
class AgentsSearch extends Agents
{
    public $type;
    public $kind;
    public $fullname;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'kind_id', 'type_id', 'gender'], 'integer'],
            [['name','type','kind', 'f', 'i', 'o', 'fullname'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Agents::find();

        $query->joinWith(['agentsKind']);
        //$query->select("IF( ISNULL(`agents`.`f`), `agents`.`name`, concat(`agents`.`f`,`agents`.`i`,`agents`.`o`)) as `fullname`, `agents`.*");
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['kind'] = [
            'asc' => ['agent_kinds.name' => SORT_ASC],
            'desc' => ['agent_kinds.name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['type'] = [
            'asc' => ['agent_types.name' => SORT_ASC],
            'desc' => ['agent_types.name' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'agents.type_id' => $this->type_id,
            'kind_id' => $this->kind_id,
            'gender' => $this->gender,
        ]);

        $query->andFilterWhere(['like', 'f', $this->name]);

        $query->andFilterWhere(['like', 'agents.fullname', $this->name]);

        $query->andFilterWhere(['like', 'agents.name', $this->name])
              ->andFilterWhere(['like', 'f', $this->f])
              ->andFilterWhere(['like', 'i', $this->i])
              ->andFilterWhere(['like', 'o', $this->o]);

        $query->andFilterWhere(['like', 'agents.fullname', $this->fullname]);

        return $dataProvider;
    }
}
