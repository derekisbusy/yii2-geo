<?php

namespace derekisbusy\geo\backend\modules\geo;

/**
 * geo module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'derekisbusy\geo\backend\modules\geo\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
    
    
    public function registerTranslations()
    {
        Yii::$app->i18n->translations['geo/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath' => '@vendor/derekisbusy/yii2-geo/messages',
        ];
    }
    
}
