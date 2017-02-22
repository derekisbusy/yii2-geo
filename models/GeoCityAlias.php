<?php

namespace derekisbusy\geo\models;

use \derekisbusy\geo\models\base\GeoCityAlias as BaseGeoCityAlias;

/**
 * This is the model class for table "geo_city_alias".
 */
class GeoCityAlias extends BaseGeoCityAlias
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['alias', 'city_id'], 'required'],
            [['city_id'], 'integer'],
            [['alias'], 'string', 'max' => 100],
        ]);
    }
	
}
