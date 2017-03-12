<?php

namespace derekisbusy\geo\frontend\modules\geo;

/**
 * geo module definition class
 */
class Module extends \derekisbusy\geo\BaseModule
{
    
    const VIEW_INDEX = 1;
    const VIEW_STATE = 2;
    const VIEW_COUNTY = 3;
    const VIEW_CITY = 4;
    
    public $viewSettings = [];
    
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'derekisbusy\geo\frontend\modules\geo\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->viewSettings = array_replace_recursive([
            self::VIEW_INDEX => 'index',
            self::VIEW_STATE => 'state',
            self::VIEW_COUNTY => 'county',
            self::VIEW_CITY => 'city'
        ], $this->viewSettings);
    }
}
