<?php

namespace derekisbusy\geo\models\base;

use Yii;

if (!defined('YII2_GEO_MODULE')) {
    define('YII2_GEO_MODULE', 'geo');
}

/**
 * This is the base model class for all other base model classes.
 *
 * @property integer $status
 *
 * @property derekisbusy\geo\models\GeoCity[] $geoCities
 * @property derekisbusy\geo\models\GeoState $state
 * @property derekisbusy\geo\models\GeoZip[] $geoZips
 */
class ActiveRecord extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 2;
    
    public static $db;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['status', 'in', 'range' => array_keys(self::getStatusOptions())]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'status' => Yii::t('geo', 'Status'),
        ];
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
    
    
    public static function getDb()
    {
        if (self::$db instanceof yii\db\Connection) {
             return self::$db;
        } else if (isset(Yii::$app)) {
            $db = Yii::$app->getModule(YII2_GEO_MODULE)->db;
            return Yii::$app->{$db};
        } else if (defined('YII2_GEO_DB')) {
            return YII2_GEO_DB;
        } else {
            throw new \Exception("Database object not set!");
        }
    }
    
    public function setDb($db) {
        self::$db = $db;
    }
}
