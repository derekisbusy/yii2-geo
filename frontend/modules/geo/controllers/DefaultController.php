<?php

namespace derekisbusy\geo\frontend\modules\geo\controllers;

use derekisbusy\geo\frontend\modules\geo\Module;
use derekisbusy\geo\models\base\ActiveRecord;
use derekisbusy\geo\models\GeoCity;
use derekisbusy\geo\models\GeoCityAlias;
use derekisbusy\geo\models\GeoCityAliasSearch;
use derekisbusy\geo\models\GeoCounty;
use derekisbusy\geo\models\GeoState;
use derekisbusy\geo\models\GeoStateSearch;
use Yii;
use yii\web\Controller;

/**
 * Default controller for the `geo` module
 */
class DefaultController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new GeoStateSearch;
        $searchModel->status = GeoState::STATUS_ACTIVE;
        $dataProvider = $searchModel->search(\Yii::$app->request->getQueryParams());
        return $this->render($this->module->viewSettings[Module::VIEW_INDEX],['dataProvider'=>$dataProvider,'searchModel'=>$searchModel]);
    }
    
    public function actionState($stateCode, $stateName)
    {
        $stateName = str_replace('_',' ',$stateName);
        $state = GeoState::find()->where(['LIKE','state', $stateName])->andWhere(['state_code' => $stateCode])->one();
        if ($state === null) {
            throw new \yii\web\NotFoundHttpException(Yii::t('common', 'The page could not be found.'));
        }
        $searchModel = new GeoCityAliasSearch;
        $searchModel->state = $state->id;
        $searchModel->status = ActiveRecord::STATUS_ACTIVE;
        $searchModel->city_status = ActiveRecord::STATUS_ACTIVE;
        $searchModel->county_status = ActiveRecord::STATUS_ACTIVE;
        $request = \Yii::$app->request;
        $dataProvider = $searchModel->search($request->getQueryParams());
        $dataProvider->query->addGroupBy(GeoCityAlias::tableName().'.id');
        $dataProvider->query->addGroupBy(GeoCityAlias::tableName().'.alias');
        return $this->render($this->module->viewSettings[Module::VIEW_STATE],['dataProvider'=>$dataProvider,'searchModel'=>$searchModel, 'state' => $state]);
    }
    
    public function actionCity($stateCode, $stateName, $cityName)
    {
        $cityName = str_replace('_',' ',$cityName);
        $city = GeoCity::find()->withState()->active()->where(['LIKE','city',$cityName])->andWhere(['state_code' => $stateCode, 'state' => $stateName])->one();
        if ($city === null) {
            throw new \yii\web\NotFoundHttpException(Yii::t('common', 'The page could not be found.'));
        }
        return $this->render($this->module->viewSettings[Module::VIEW_CITY],array('city'=>$city));
    }
    
    public function actionCounty($stateCode, $stateName, $countyName)
    {
        $countyName = str_replace('_county','',$countyName);
        $countyName = str_replace('_',' ',$countyName);
        $county = GeoCounty::find()->withState()->active()->where(['LIKE','county',$countyName])->andWhere(['state_code' => $stateCode, 'state' => $stateName])->one();
        if ($county === null) {
            throw new \yii\web\NotFoundHttpException(Yii::t('common', 'The page could not be found.'));
        }
        return $this->render($this->module->viewSettings[Module::VIEW_COUNTY],array('county'=>$county));
    }
}
