<?php

namespace derekisbusy\geo\models\base;

use derekisbusy\geo\models\GeoCityQuery;
use Yii;

/**
 * This is the base model class for table "{{%geo_city}}".
 *
 * @property string $id
 * @property string $city
 * @property integer $state_id
 * @property string $county_id
 * @property integer $status
 *
 * @property GeoCounty $county
 * @property GeoState $state
 * @property GeoZip[] $geoZips
 */
class GeoCity extends ActiveRecord
{
    
    public function __toString()
    {
        return $this->city;
    }
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(parent::rules(),[
            [['city', 'state_id', 'county_id'], 'required'],
            [['state_id', 'county_id'], 'integer'],
            [['city'], 'string', 'max' => 50]
        ]);
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
        return array_merge(parent::attributeLabels(),[
            'id' => Yii::t('geo', 'ID'),
            'city' => Yii::t('geo', 'City'),
            'state_id' => Yii::t('geo', 'State'),
            'county_id' => Yii::t('geo', 'County'),
        ]);
    }
    
    public function beforeValidate()
    {
        if ($this->county_id) {
            $county = GeoCounty::findOne($this->county_id);
            $this->state_id = $county->state_id;
        }
        return parent::beforeValidate();
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCounty()
    {
        return $this->hasOne(GeoCounty::className(), ['id' => 'county_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getState()
    {
        return $this->hasOne(GeoState::className(), ['id' => 'state_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGeoZips()
    {
        return $this->hasMany(GeoZip::className(), ['city_id' => 'id']);
    }
    
    /**
     * @inheritdoc
     * @return GeoCityQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GeoCityQuery(get_called_class());
    }
}
