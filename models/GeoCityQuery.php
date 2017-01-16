<?php

namespace derekisbusy\geo\models;

/**
 * This is the ActiveQuery class for [[GeoCity]].
 *
 * @see GeoCity
 */
class GeoCityQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

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