<?php

namespace vendor\derekisbusy\geo\models;

/**
 * This is the ActiveQuery class for [[GeoZip]].
 *
 * @see GeoZip
 */
class GeoZipQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return GeoZip[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return GeoZip|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}