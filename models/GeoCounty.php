<?php

namespace derekisbusy\geo\models;

use \derekisbusy\geo\models\base\GeoCounty as BaseGeoCounty;

/**
 * This is the model class for table "geo_county".
 */
class GeoCounty extends BaseGeoCounty
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['county', 'state_id'], 'required'],
            [['state_id'], 'integer'],
            [['county'], 'string', 'max' => 100]
        ]);
    }
	
}
