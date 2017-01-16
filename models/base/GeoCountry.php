<?php

namespace derekisbusy\geo\models\base;

use Yii;

/**
 * This is the base model class for table "{{%geo_country}}".
 *
 * @property integer $id
 * @property string $country_code
 * @property string $country
 */
class GeoCountry extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    
    public function __toString()
    {
        return $this->country;
    }
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['country_code', 'country'], 'required'],
            [['country_code'], 'string', 'max' => 2],
            [['country'], 'string', 'max' => 50],
            [['country'], 'unique'],
            [['country_code'], 'unique']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%geo_country}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('geo', 'ID'),
            'country_code' => Yii::t('geo', 'Country Code'),
            'country' => Yii::t('geo', 'Country'),
        ];
    }

    /**
     * @inheritdoc
     * @return \derekisbusy\geo\models\GeoCountryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \derekisbusy\geo\models\GeoCountryQuery(get_called_class());
    }
}
