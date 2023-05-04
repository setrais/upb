<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Files;

/**
 * FilesSearch represents the model behind the search form about `backend\models\Files`.
 */
class FilesSearch extends Files
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'order', 'height', 'width', 'file_size', 'created_user', 'updated_user'], 'integer'],
            [['uid', 'status', 'name', 'timetamp_x', 'ext', 'subdir', 'file_name', 'original_name', 'content_type', 'module_id', 'handler_id', 'created', 'updated', 'description', 'action', 'controller'], 'safe'],
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
        $query = Files::find();

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
            'timetamp_x' => $this->timetamp_x,
            'order' => $this->order,
            'height' => $this->height,
            'width' => $this->width,
            'file_size' => $this->file_size,
            'created_user' => $this->created_user,
            'updated_user' => $this->updated_user,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'uid', $this->uid])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'ext', $this->ext])
            ->andFilterWhere(['like', 'subdir', $this->subdir])
            ->andFilterWhere(['like', 'file_name', $this->file_name])
            ->andFilterWhere(['like', 'original_name', $this->original_name])
            ->andFilterWhere(['like', 'content_type', $this->content_type])
            ->andFilterWhere(['like', 'module_id', $this->module_id])
            ->andFilterWhere(['like', 'handler_id', $this->handler_id])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'action', $this->action])
            ->andFilterWhere(['like', 'controller', $this->controller]);

        return $dataProvider;
    }
}
