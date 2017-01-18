<?php

namespace derekisbusy\geo\models;

use \derekisbusy\geo\models\base\GeoState as BaseGeoState;

/**
 * This is the model class for table "geo_state".
 */
class GeoState extends BaseGeoState
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['state', 'state_code'], 'required'],
            [['state'], 'string', 'max' => 22],
            [['state_code'], 'string', 'max' => 2],
            [['state_code'], 'unique']
        ]);
    }
	
    public static function getStates() {
        $states = self::find()->asArray()->all();
        $state_ids[0] = "";
        foreach($states as $state) {
            $state_ids[$state['id']] = $state['state_code'];
        }
        return $state_ids;
    }
}
