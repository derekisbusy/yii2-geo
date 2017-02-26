<?php

namespace derekisbusy\geo\models\base;

use Yii;

/**
 * This is the base model class for table "{{%geo_zip}}".
 *
 * @property string $id
 * @property string $zip
 * @property double $latitude
 * @property double $longitude
 * @property string $county_id
 * @property integer $state_id
 * @property string $city_id
 *
 * @property \derekisbusy\geo\models\GeoCity $city
 * @property \derekisbusy\geo\models\GeoCounty $county
 * @property \derekisbusy\geo\models\GeoState $state
 */
class GeoZip extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    public function __toString()
    {
        return $this->zip;
    }
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['zip', 'latitude', 'longitude', 'county_id', 'state_id', 'city_id'], 'required'],
            [['zip', 'county_id', 'state_id', 'city_id'], 'integer'],
            [['latitude', 'longitude'], 'number']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%geo_zip}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('geo', 'ID'),
            'zip' => Yii::t('geo', 'Zip'),
            'latitude' => Yii::t('geo', 'Latitude'),
            'longitude' => Yii::t('geo', 'Longitude'),
            'county_id' => Yii::t('geo', 'County'),
            'state_id' => Yii::t('geo', 'State'),
            'city_id' => Yii::t('geo', 'City'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(\derekisbusy\geo\models\GeoCity::className(), ['id' => 'city_id']);
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
     * @inheritdoc
     * @return \derekisbusy\geo\models\GeoZipQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \derekisbusy\geo\models\GeoZipQuery(get_called_class());
    }
    
    public function beforeValidate()
    {
        if ($this->city_id) {
            $city = \derekisbusy\geo\models\base\GeoCity::findOne($this->city_id);
            $this->state_id = $city->state_id;
            $this->county_id = $city->county_id;
        }
        return parent::beforeValidate();
    }
}
