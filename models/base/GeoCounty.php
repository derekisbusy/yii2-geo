<?php

namespace derekisbusy\geo\models\base;

use Yii;

/**
 * This is the base model class for table "{{%geo_county}}".
 *
 * @property string $id
 * @property string $county
 * @property integer $state_id
 *
 * @property derekisbusy\geo\models\GeoCity[] $geoCities
 * @property derekisbusy\geo\models\GeoState $state
 * @property derekisbusy\geo\models\GeoZip[] $geoZips
 */
class GeoCounty extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 2;
    
    public function __toString() {
        return $this->county;
    }
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['county', 'state_id'], 'required'],
            [['state_id'], 'integer'],
            [['county'], 'string', 'max' => 100],
            ['status', 'in', 'range' => array_keys(self::getStatusOptions())]
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
            'state' => Yii::t('geo', 'State'),
            'status' => Yii::t('geo', 'Status'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGeoCities()
    {
        return $this->hasMany(\derekisbusy\geo\models\GeoCity::className(), ['county_id' => 'id']);
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
        return $this->hasMany(\derekisbusy\geo\models\GeoZip::className(), ['county_id' => 'id']);
    }
    
    /**
     * @inheritdoc
     * @return derekisbusy\geo\models\GeoCountyQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \derekisbusy\geo\models\GeoCountyQuery(get_called_class());
    }
    
    public static function getCountyNameById($county_id)
    {
        return self::findOne($county_id)->county;
    }
    
    public static function getStatusOptions()
    {
        return [
            self::STATUS_ACTIVE => Yii::t('geo', 'Active'),
            self::STATUS_INACTIVE => Yii::t('geo', 'Inactive'),
            self::STATUS_DELETED => Yii::t('geo', 'Deleted'),
        ];
    }
    
    public static function getStatusLabelTypes()
    {
        return [
            self::STATUS_ACTIVE => 'success',
            self::STATUS_INACTIVE => 'default',
            self::STATUS_DELETED => 'danger',
        ];
    }
}
