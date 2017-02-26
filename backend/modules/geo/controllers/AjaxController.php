<?php

namespace derekisbusy\geo\backend\modules\geo\controllers;

use Yii;
use yii\web\Response;

class AjaxController extends \yii\web\Controller
{   
    public function actionCity($q = null, $id = null, $state = null, $county = null, $showState = true)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $result = ['results' => []];
        $query = \derekisbusy\geo\models\GeoCity::find()->limit(50);
        
        if ($id) {
            $query->where(['id' => $id]);
        } elseif ($q) {
            $query->where(['LIKE', "city", $q]);
        }
        
        if ($state) {
            $query->andWhere(['state_id' => $state]);
        }
        
        if ($county) {
            $query->andWhere(['county_id' => $county]);
        }

        foreach($query->each() as $city) {
            $result['results'][] = ['id' => $city->id,'text' => $city->city . ($showState ? ', '. $city->state->state_code : null)];
        }
        return $result;
    }
    
    public function actionCounty($q = null, $id = null, $state = null, $showState = true)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $result = ['results' => []];
        $query = \derekisbusy\geo\models\GeoCounty::find()->limit(50);
        
        if ($id) {
            $query->where(['id' => $id]);
        } elseif ($q) {
            $query->where(['LIKE', "county", $q]);
        }
        
        if ($state) {
            $query->andWhere(['state_id' => $state]);
        }

        foreach($query->each() as $county) {
            $result['results'][] = ['id' => $county->id,'text' => $county->county . ($showState ? ', '. $county->state->state_code : null)];
        }
        return $result;
    }

}
