<?php

namespace vendor\derekisbusy\geo\models\base;

use Yii;

/**
 * This is the base model class for table "{{%geo_county}}".
 *
 * @property string $id
 * @property string $county
 * @property integer $state_id
 *
 * @property \vendor\derekisbusy\geo\models\GeoCity[] $geoCities
 * @property \vendor\derekisbusy\geo\models\GeoState $state
 * @property \vendor\derekisbusy\geo\models\GeoZip[] $geoZips
 */
class GeoCounty extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['county', 'state_id'], 'required'],
            [['state_id'], 'integer'],
            [['county'], 'string', 'max' => 100]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%geo_county}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('geo', 'ID'),
            'county' => Yii::t('geo', 'County'),
            'state_id' => Yii::t('geo', 'State ID'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGeoCities()
    {
        return $this->hasMany(\vendor\derekisbusy\geo\models\GeoCity::className(), ['county_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getState()
    {
        return $this->hasOne(\vendor\derekisbusy\geo\models\GeoState::className(), ['id' => 'state_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGeoZips()
    {
        return $this->hasMany(\vendor\derekisbusy\geo\models\GeoZip::className(), ['county_id' => 'id']);
    }
    
    /**
     * @inheritdoc
     * @return \vendor\derekisbusy\geo\models\GeoCountyQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \vendor\derekisbusy\geo\models\GeoCountyQuery(get_called_class());
    }
}
