<?php

namespace derekisbusy\geo\models;

use \derekisbusy\geo\models\base\GeoCity as BaseGeoCity;

/**
 * This is the model class for table "geo_city".
 */
class GeoCity extends BaseGeoCity
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(parent::rules(),
	    [
            [['city', 'state_id', 'county_id'], 'required'],
            [['state_id', 'county_id'], 'integer'],
            [['city'], 'string', 'max' => 50]
        ]);
    }
	
}
