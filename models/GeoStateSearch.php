<?php

namespace derekisbusy\geo\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use derekisbusy\geo\models\GeoState;

/**
 * derekisbusy\geo\models\GeoStateSearch represents the model behind the search form about `derekisbusy\geo\models\GeoState`.
 */
 class GeoStateSearch extends GeoState
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['state', 'state_code'], 'safe'],
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
        $query = GeoState::find();

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

        $query->andFilterWhere(['like', 'state', $this->state])
            ->andFilterWhere(['like', 'state_code', $this->state_code]);

        return $dataProvider;
    }
}
