<?php

namespace derekisbusy\geo\models;

use \derekisbusy\geo\models\base\GeoCountry as BaseGeoCountry;

/**
 * This is the model class for table "geo_country".
 */
class GeoCountry extends BaseGeoCountry
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['country_code', 'country'], 'required'],
            [['country_code'], 'string', 'max' => 2],
            [['country'], 'string', 'max' => 50],
            [['country'], 'unique'],
            [['country_code'], 'unique']
        ]);
    }
	
}
