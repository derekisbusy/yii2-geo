<?php

namespace vendor\derekisbusy\geo\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use vendor\derekisbusy\geo\models\GeoZip;

/**
 * vendor\derekisbusy\geo\models\GeoZipSearch represents the model behind the search form about `vendor\derekisbusy\geo\models\GeoZip`.
 */
 class GeoZipSearch extends GeoZip
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'zip', 'county_id', 'state_id', 'city_id'], 'integer'],
            [['latitude', 'longitude'], 'number'],
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
        $query = GeoZip::find();

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
            'zip' => $this->zip,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'county_id' => $this->county_id,
            'state_id' => $this->state_id,
            'city_id' => $this->city_id,
        ]);

        return $dataProvider;
    }
}
