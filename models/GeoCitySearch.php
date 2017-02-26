<?php

namespace derekisbusy\geo\models;

use derekisbusy\geo\models\GeoCity;
use derekisbusy\geo\models\GeoState;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * derekisbusy\geo\models\GeoCitySearch represents the model behind the search form about `derekisbusy\geo\models\GeoCity`.
 */
 class GeoCitySearch extends GeoCity
{
     public $state;
     public $county;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'state', 'county'], 'integer'],
            [['city'], 'safe'],
            ['state', 'exist', 'targetClass' => GeoState::className(), 'targetAttribute' => 'id'],
            ['county', 'exist', 'targetClass' => GeoCounty::className(), 'targetAttribute' => 'id'],
            ['status', 'in', 'range' => array_keys(GeoCity::getStatusOptions())]
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
        $query = GeoCity::find();
        $query->joinWith(['state']);
        $query->joinWith(['county']);

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

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
             $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'state_id' => $this->state,
            'county_id' => $this->county,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'city', $this->city]);

        return $dataProvider;
    }
}
