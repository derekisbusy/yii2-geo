<?php

namespace derekisbusy\geo\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use derekisbusy\geo\models\GeoCounty;

/**
 * derekisbusy\geo\models\GeoCountySearch represents the model behind the search form about `derekisbusy\geo\models\GeoCounty`.
 */
 class GeoCountySearch extends GeoCounty
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'state_id'], 'integer'],
            [['county'], 'safe'],
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
        $query = GeoCounty::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'state_id' => $this->state_id,
        ]);

        $query->andFilterWhere(['like', 'county', $this->county]);

        return $dataProvider;
    }
}
