<?php

namespace derekisbusy\geo\models;

/**
 * This is the ActiveQuery class for [[GeoCountry]].
 *
 * @see GeoCountry
 */
class GeoCountryQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return GeoCountry[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return GeoCountry|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}