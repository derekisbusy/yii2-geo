<?php

namespace vendor\derekisbusy\geo\models;

/**
 * This is the ActiveQuery class for [[GeoState]].
 *
 * @see GeoState
 */
class GeoStateQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return GeoState[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return GeoState|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}