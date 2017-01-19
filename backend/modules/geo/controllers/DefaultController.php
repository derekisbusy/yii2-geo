<?php

namespace derekisbusy\geo\backend\modules\geo\controllers;

use yii\web\Controller;

/**
 * Default controller for the `geo` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
