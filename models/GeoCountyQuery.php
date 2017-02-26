<?php

namespace derekisbusy\geo\models;

/**
 * This is the ActiveQuery class for [[GeoCounty]].
 *
 * @see GeoCounty
 */
class GeoCountyQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        $this->andWhere('[[status]]='.GeoCounty::STATUS_ACTIVE);
        return $this;
    }

    public function withState($state = null)
    {
        $this->innerJoin(GeoState::tableName(), GeoCounty::tableName().'.state_id = '.GeoState::tableName().'.id');
        return $this;
    }
    
    /**
     * @inheritdoc
     * @return GeoCounty[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return GeoCounty|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}