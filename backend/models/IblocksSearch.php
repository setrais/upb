<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Iblocks;

/**
 * IblocksSearch represents the model behind the search form about `backend\models\Iblocks`.
 */
class IblocksSearch extends Iblocks
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'grid', 'pic_anons_id', 'pic_detile_id', 'act', 'del', 'createusers', 'updateusers', 'sort', 'is_main', 'is_pay', 'is_arhiv', 'is_use', 'types_iblocks_id', 'city_id', 'is_resize', 'pic_oreginal_id', 'pic_scr_id'], 'integer'],
            [['uid', 'name', 'sid', 'title', 'keywords', 'description', 'anons', 'createdate', 'updatedate', 'detile', 'cid', 'maps_id', 'url', 'url_detile', 'url_list', 'visible', 'action', 'nid'], 'safe'],
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
        $query = Iblocks::find();

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
            'grid' => $this->grid,
            'pic_anons_id' => $this->pic_anons_id,
            'pic_detile_id' => $this->pic_detile_id,
            'act' => $this->act,
            'del' => $this->del,
            'createusers' => $this->createusers,
            'DATE_FORMAT(createdate, \'%d-%m-%Y\')' => $this->createdate,
            'updateusers' => $this->updateusers,
            'updatedate' => $this->updatedate,
            'sort' => $this->sort,
            'is_main' => $this->is_main,
            'is_pay' => $this->is_pay,
            'is_arhiv' => $this->is_arhiv,
            'is_use' => $this->is_use,
            'types_iblocks_id' => $this->types_iblocks_id,
            'city_id' => $this->city_id,
            'is_resize' => $this->is_resize,
            'pic_oreginal_id' => $this->pic_oreginal_id,
            'pic_scr_id' => $this->pic_scr_id,
        ]);


        $query->andFilterWhere(['like', 'uid', $this->uid])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'sid', $this->sid])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'keywords', $this->keywords])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'anons', $this->anons])
            ->andFilterWhere(['like', 'detile', $this->detile])
            ->andFilterWhere(['like', 'cid', $this->cid])
            ->andFilterWhere(['like', 'maps_id', $this->maps_id])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'url_detile', $this->url_detile])
            ->andFilterWhere(['like', 'url_list', $this->url_list])
            ->andFilterWhere(['like', 'visible', $this->visible])
            ->andFilterWhere(['like', 'action', $this->action])
            ->andFilterWhere(['like', 'nid', $this->nid]);

        return $dataProvider;
    }

}
