<?php

namespace derekisbusy\geo;

use Yii;


/**
 * medical module definition class
 */
class BaseModule extends \yii\base\Module
{

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

        // custom initialization code goes here
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
