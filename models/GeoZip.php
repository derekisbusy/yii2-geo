<?php

namespace derekisbusy\geo\models;

use \derekisbusy\geo\models\base\GeoZip as BaseGeoZip;

/**
 * This is the model class for table "geo_zip".
 */
class GeoZip extends BaseGeoZip
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['zip', 'latitude', 'longitude', 'county_id', 'state_id', 'city_id'], 'required'],
            [['zip', 'county_id', 'state_id', 'city_id'], 'integer'],
            [['latitude', 'longitude'], 'number']
        ]);
    }
	
}
