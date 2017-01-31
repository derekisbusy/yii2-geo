<?php

namespace derekisbusy\geo\models;

/**
 * This is the ActiveQuery class for [[GeoCity]].
 *
 * @see GeoCity
 */
class GeoCityQuery extends \yii\db\ActiveQuery
{
    public function stateCode($state_code)
    {
        $this->where(['state_code' => $state_code]);
        return $this;
    }

    
    public function withState($state = null)
    {
        $this->innerJoin(GeoState::tableName(), GeoCity::tableName().'.state_id = '.GeoState::tableName().'.id');
        return $this;
    }
    /**
     * @inheritdoc
     * @return GeoCity[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return GeoCity|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}