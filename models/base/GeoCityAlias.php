<?php

namespace derekisbusy\geo\models\base;

use Yii;


/**
 * This is the base model class for table "{{%geo_city_alias}}".
 *
 * @property integer $id
 * @property string $alias
 * @property integer $city_id
 */
class GeoCityAlias extends ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(parent::rules(),[
            [['alias', 'city_id'], 'required'],
            [['city_id'], 'integer'],
            [['alias'], 'string', 'max' => 100],
        ]);
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%geo_city_alias}}';
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(),[
            'id' => Yii::t('geo', 'ID'),
            'alias' => Yii::t('geo', 'Alias'),
            'city_id' => Yii::t('geo', 'City ID'),
        ]);
    }

/**
     * @inheritdoc
     * @return array mixed
     */ 
    public function behaviors()
    {
        return [];
    }

    /**
     * @inheritdoc
     * @return \derekisbusy\geo\models\GeoCityAliasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \derekisbusy\geo\models\GeoCityAliasQuery(get_called_class());
    }
    
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(\derekisbusy\geo\models\GeoCity::className(), ['id' => 'city_id']);
    }
}
