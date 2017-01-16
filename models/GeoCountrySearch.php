<?php

namespace derekisbusy\geo\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use derekisbusy\geo\models\GeoCountry;

/**
 * derekisbusy\geo\models\GeoCountrySearch represents the model behind the search form about `derekisbusy\geo\models\GeoCountry`.
 */
 class GeoCountrySearch extends GeoCountry
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['country_code', 'country'], 'safe'],
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
        $query = GeoCountry::find();

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
        ]);

        $query->andFilterWhere(['like', 'country_code', $this->country_code])
            ->andFilterWhere(['like', 'country', $this->country]);

        return $dataProvider;
    }
}
