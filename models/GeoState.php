<?php

namespace derekisbusy\geo\models;

use \derekisbusy\geo\models\base\GeoState as BaseGeoState;

/**
 * This is the model class for table "geo_state".
 */
class GeoState extends BaseGeoState
{
	
    public static function getStates() {
        $states = self::find()->asArray()->all();
        $state_ids[0] = "";
        foreach($states as $state) {
            $state_ids[$state['id']] = $state['state_code'];
        }
        return $state_ids;
    }
}
