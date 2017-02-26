<?php

namespace derekisbusy\geo\models;

use derekisbusy\geo\models\GeoZip;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * derekisbusy\geo\models\GeoZipSearch represents the model behind the search form about `derekisbusy\geo\models\GeoZip`.
 */
 class GeoZipSearch extends GeoZip
{
    public $state;
    public $county;
    public $city;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'zip', 'county_id', 'state_id', 'city_id'], 'integer'],
            [['latitude', 'longitude'], 'number'],
            ['state', 'exist', 'targetClass' => GeoState::className(), 'targetAttribute' => 'id'],
            ['county', 'exist', 'targetClass' => GeoCounty::className(), 'targetAttribute' => 'id'],
            ['city', 'exist', 'targetClass' => GeoCity::className(), 'targetAttribute' => 'id'],
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
        $query->joinWith(['state','county','city']);


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['state'] = [
            'asc' => [GeoState::tableName().'.state' => SORT_ASC],
            'desc' => [GeoState::tableName().'.state' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['county'] = [
            'asc' => [GeoState::tableName().'.county' => SORT_ASC],
            'desc' => [GeoState::tableName().'.county' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['city'] = [
            'asc' => [GeoState::tableName().'.city' => SORT_ASC],
            'desc' => [GeoState::tableName().'.city' => SORT_DESC],
        ];
        
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
            GeoZip::tableName().'.county_id' => $this->county,
            GeoZip::tableName().'.state_id' => $this->state,
            'city_id' => $this->city,
        ]);

        return $dataProvider;
    }
}
