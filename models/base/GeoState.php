<?php

namespace derekisbusy\geo\models\base;

use derekisbusy\geo\models\GeoStateQuery;
use Yii;

/**
 * This is the base model class for table "{{%geo_state}}".
 *
 * @property integer $id
 * @property string $state
 * @property string $state_code
 * @property string $abbr
 * @property string $demonym
 * @property string $adjective
 * @property integer $status
 *
 * @property GeoCity[] $geoCities
 * @property GeoCounty[] $geoCounties
 * @property GeoZip[] $geoZips
 */
class GeoState extends ActiveRecord
{

    public function __toString()
    {
        return $this->state;
    }
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(parent::rules(),[
            [['state', 'state_code'], 'required'],
            [['state'], 'string', 'max' => 22],
            [['abbr'], 'string', 'max' => 10],
            [['demonym','adjective'], 'string', 'max' => 30],
            [['state_code'], 'string', 'max' => 2],
            [['state_code','state'], 'unique'],
        ]);
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%geo_state}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(),[
            'id' => Yii::t('geo', 'ID'),
            'state' => Yii::t('geo', 'State'),
            'state_code' => Yii::t('geo', 'State Code'),
            'abbr' => Yii::t('geo', 'Abbr'),
            'demonym' => Yii::t('geo', 'Demonym'),
            'adjective' => Yii::t('geo', 'Adjective'),
        ]);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGeoCities()
    {
        return $this->hasMany(GeoCity::className(), ['state_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGeoCounties()
    {
        return $this->hasMany(GeoCounty::className(), ['state_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGeoZips()
    {
        return $this->hasMany(GeoZip::className(), ['state_id' => 'id']);
    }
    
    /**
     * @inheritdoc
     * @return GeoStateQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GeoStateQuery(get_called_class());
    }
}
