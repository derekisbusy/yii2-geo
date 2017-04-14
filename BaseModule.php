<?php

namespace derekisbusy\geo;

use Yii;


/**
 * medical module definition class
 */
class BaseModule extends \yii\base\Module
{

    const MODEL_GEO_CITY = 1;
    const MODEL_GEO_CITY_QUERY = 2;
    const MODEL_GEO_CITY_SEARCH = 3;
    const MODEL_GEO_CITY_ALIAS = 4;
    const MODEL_GEO_CITY_ALIAS_SEARCH = 5;
    const MODEL_GEO_CITY_ALIAS_QUERY = 6;
    const MODEL_GEO_COUNTRY = 7;
    const MODEL_GEO_COUNTRY_QUERY = 8;
    const MODEL_GEO_COUNTRY_SEARCH = 9;
    const MODEL_GEO_COUNTY = 10;
    const MODEL_GEO_COUNTY_QUERY = 11;
    const MODEL_GEO_COUNTY_SEARCH = 12;
    const MODEL_GEO_STATE = 13;
    const MODEL_GEO_STATE_QUERY = 14;
    const MODEL_GEO_STATE_SEARCH = 15;
    const MODEL_GEO_ZIP = 16;
    const MODEL_GEO_ZIP_QUERY = 17;
    const MODEL_GEO_ZIP_SEARCH = 18;
    
    const PERM_MANAGE_GEO = 1;
    const PERM_EXPORT = 2;
    const PERM_DELETE = 3;
    const PERM_CREATE = 4;
    
    const VIEW_INDEX = 1;
    const VIEW_CITY = 2;
    const VIEW_COUNTY = 3;
    const VIEW_STATE = 4;
    
    public $modelSettings = [];
    
    
    public $backendRoles = [];
    public $frontendRoles = [];
    
    public $db = 'db';
    public $userClass = 'app\models\User';
    public $userTableIdColumn = 'id';
    
    
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->modelSettings = array_replace_recursive([
            self::MODEL_GEO_CITY => 'derekisbusy\geo\models\GeoCity',
            self::MODEL_GEO_CITY_ALIAS => 'derekisbusy\geo\models\GeoCityAlias',
            self::MODEL_GEO_CITY_ALIAS_QUERY => 'derekisbusy\geo\models\GeoCityAliasQuery',
            self::MODEL_GEO_CITY_ALIAS_SEARCH => 'derekisbusy\geo\models\GeoCityAliasSearch',
            self::MODEL_GEO_CITY_QUERY => 'derekisbusy\geo\models\GeoCityQuery',
            self::MODEL_GEO_CITY_SEARCH => 'derekisbusy\geo\models\GeoCitySearch',
            self::MODEL_GEO_COUNTRY => 'derekisbusy\geo\models\GeoCountrySearch',
            self::MODEL_GEO_COUNTRY_QUERY => 'derekisbusy\geo\models\GeoCountryQuery',
            self::MODEL_GEO_COUNTRY_SEARCH => 'derekisbusy\geo\models\GeoCountrySearch',
            self::MODEL_GEO_STATE => 'derekisbusy\geo\models\GeoState',
            self::MODEL_GEO_STATE_QUERY => 'derekisbusy\geo\models\GeoStateQuery',
            self::MODEL_GEO_STATE_SEARCH => 'derekisbusy\geo\models\GeoStateSearch',
            self::MODEL_GEO_ZIP => 'derekisbusy\geo\models\GeoZip',
            self::MODEL_GEO_ZIP_QUERY => 'derekisbusy\geo\models\GeoZipQuery',
            self::MODEL_GEO_ZIP_SEARCH => 'derekisbusy\geo\models\GeoZipSearch',
        ], $this->modelSettings);
        
    }
    
    public static function getUserClassname()
    {
        return 'dektrium\user\models\User';
    }
    
    public static function getUserModelIdName()
    {
        return 'id';
    }
    
    public static function getUserTableName()
    {
        return call_user_func(self::getUserClassname().'::tableName');
    }
    
    public function isBackendUser()
    {
        $roles = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
        foreach ($roles as $role) {
            if (in_array($role->name, $this->backendRoles)) {
                return true;
            }
        }
        
        return false;
    }
    
    public function isFrontendUser()
    {
        $roles = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
        foreach ($roles as $role) {
            if (in_array($role->name, $this->frontendRoles)) {
                return true;
            }
        }
        
        return false;
    }
}
