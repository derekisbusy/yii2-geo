<?php

namespace derekisbusy\geo\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use derekisbusy\geo\models\GeoCityAlias;

/**
 * derekisbusy\geo\models\GeoCityAliasSearch represents the model behind the search form about `derekisbusy\geo\models\GeoCityAlias`.
 */
 class GeoCityAliasSearch extends GeoCityAlias
{
    public $state;
    public $county;
    public $city;
    public $state_id;
    public $city_status;
    public $county_status;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'city_id','state_id', 'city_status'], 'integer'],
            [['alias','county'], 'safe'],
            [['city_status', 'county_status', 'status'], 'in', 'range' => array_keys(base\ActiveRecord::getStatusOptions())],
            ['state', 'exist', 'targetClass' => GeoState::className(), 'targetAttribute' => 'id'],
            ['county', 'exist', 'targetClass' => GeoCounty::className(), 'targetAttribute' => 'id'],
            ['city', 'exist', 'targetClass' => GeoCity::className(), 'targetAttribute' => 'id'],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'alias' => Yii::t('geo', 'City'),
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
        $query = GeoCityAlias::find();
        $query->select(GeoCityAlias::tableName().'.*');
        $query->addSelect(GeoCity::tableName().'.status as city_status');
        $query->addSelect(GeoCity::tableName().'.state_id');
        $query->addSelect(GeoCounty::tableName().'.county');
        $query->addSelect(GeoCounty::tableName().'.status as county_status');
        $query->with('city.county');
        
        
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
            $query->where('0=1');
            return $dataProvider;
        }
        
        $query->innerJoin(base\GeoCity::tableName(), base\GeoCity::tableName().'.id = '.self::tableName().'.city_id');
        $query->innerJoin(base\GeoCounty::tableName(), base\GeoCounty::tableName().'.id = '.base\GeoCity::tableName().'.county_id');

        $query->andFilterWhere([
            'id' => $this->id,
            'disabled' => 0,
            GeoCityAlias::tableName().'.status' => $this->status,
            GeoCity::tableName().'.status' => $this->city_status,
            GeoCounty::tableName().'.status' => $this->county_status,
            GeoCity::tableName().'.state_id' => $this->state_id,
            GeoCounty::tableName().'.id' => $this->county,
            GeoCity::tableName().'.state_id' => $this->state,
            'city_id' => $this->city,
        ]);

        $query->andFilterWhere(['like', 'alias', $this->alias]);
//        $query->andFilterWhere(['like', 'county', $this->county]);

        // default sort
        if (!Yii::$app->request->get('sort')) {
            $query->orderBy(['alias' => SORT_ASC]);
        }
        return $dataProvider;
    }
}
