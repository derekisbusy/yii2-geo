<?php

namespace derekisbusy\geo\modules\geo;

/**
 * geo module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'derekisbusy\geo\modules\geo\controllers';

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
        Yii::$app->i18n->translations['derekisbusy/geo/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath' => '@vendor/derekisbusy/geo/messages',
        ];
    }
    
}
