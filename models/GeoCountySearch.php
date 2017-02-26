<?php

namespace derekisbusy\geo\models;

use derekisbusy\geo\models\GeoCounty;
use derekisbusy\geo\models\GeoState;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * derekisbusy\geo\models\GeoCountySearch represents the model behind the search form about `derekisbusy\geo\models\GeoCounty`.
 */
 class GeoCountySearch extends GeoCounty
{
     public $state;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'state_id'], 'integer'],
            [['county', 'state', 'status'], 'safe'],
            ['status', 'in', 'range' => array_keys(GeoCounty::getStatusOptions())]
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
        
        $query->joinWith(['state']);
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $dataProvider->sort->attributes['state'] = [
            'asc' => [GeoState::tableName().'.state' => SORT_ASC],
            'desc' => [GeoState::tableName().'.state' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
             $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'state_id' => $this->state,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'county', $this->county]);

        return $dataProvider;
    }
}
