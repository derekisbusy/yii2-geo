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
    public $state_id;
    public $county;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'city_id','state_id'], 'integer'],
            [['alias','county'], 'safe'],
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
        $query->with('city.county');
        
        
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        
        $dataProvider->setSort([
           'attributes' => array_merge([
               'alias' => [
                    'asc' => ['alias' => SORT_ASC],
                    'desc' => ['alias' => SORT_DESC],
                    'label' => 'Order City',
                    'default' => SORT_ASC
               ],
               'county' => [
                    'asc' => ['county' => SORT_ASC],
                    'desc' => ['county' => SORT_DESC],
                    'label' => 'Order County',
                    'default' => SORT_ASC
               ],
           ],array_keys($this->attributes))
        ]);
        
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        
        $query->innerJoin(base\GeoCity::tableName(), base\GeoCity::tableName().'.id = '.self::tableName().'.city_id');
        $query->innerJoin(base\GeoCounty::tableName(), base\GeoCounty::tableName().'.id = '.base\GeoCity::tableName().'.county_id');

        $query->andFilterWhere([
            'id' => $this->id,
            'city_id' => $this->city_id,
            'disabled' => 0,
            base\GeoCity::tableName().'.state_id' => $this->state_id,
        ]);

        $query->andFilterWhere(['like', 'alias', $this->alias]);
        $query->andFilterWhere(['like', 'county', $this->county]);

        // default sort
        if (!Yii::$app->request->get('sort')) {
            $query->orderBy(['alias' => SORT_ASC]);
        }
        return $dataProvider;
    }
}