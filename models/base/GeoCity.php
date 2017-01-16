<?php

namespace derekisbusy\geo\models\base;

use Yii;

/**
 * This is the base model class for table "{{%geo_city}}".
 *
 * @property string $id
 * @property string $city
 * @property integer $state_id
 * @property string $county_id
 *
 * @property \derekisbusy\geo\models\GeoCounty $county
 * @property \derekisbusy\geo\models\GeoState $state
 * @property \derekisbusy\geo\models\GeoZip[] $geoZips
 */
class GeoCity extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    public function __toString()
    {
        return $this->city;
    }
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['city', 'state_id', 'county_id'], 'required'],
            [['state_id', 'county_id'], 'integer'],
            [['city'], 'string', 'max' => 50]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%geo_city}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('geo', 'ID'),
            'city' => Yii::t('geo', 'City'),
            'state_id' => Yii::t('geo', 'State ID'),
            'county_id' => Yii::t('geo', 'County ID'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCounty()
    {
        return $this->hasOne(\derekisbusy\geo\models\GeoCounty::className(), ['id' => 'county_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getState()
    {
        return $this->hasOne(\derekisbusy\geo\models\GeoState::className(), ['id' => 'state_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGeoZips()
    {
        return $this->hasMany(\derekisbusy\geo\models\GeoZip::className(), ['city_id' => 'id']);
    }
    
    /**
     * @inheritdoc
     * @return \derekisbusy\geo\models\GeoCityQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \derekisbusy\geo\models\GeoCityQuery(get_called_class());
    }
}
