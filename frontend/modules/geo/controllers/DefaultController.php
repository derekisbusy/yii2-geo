<?php

namespace derekisbusy\geo\frontend\modules\geo\controllers;

use derekisbusy\geo\models\GeoCity;
use derekisbusy\geo\models\GeoCityAliasSearch;
use derekisbusy\geo\models\GeoCounty;
use derekisbusy\geo\models\GeoState;
use derekisbusy\geo\models\GeoStateSearch;
use yii\web\Controller;
use Yii;

/**
 * Default controller for the `geo` module
 */
class DefaultController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new GeoStateSearch;
        $dataProvider = $searchModel->search(\Yii::$app->request->getQueryParams());
        return $this->render('index',['dataProvider'=>$dataProvider,'searchModel'=>$searchModel]);
    }
    
    public function actionState($stateCode, $stateName)
    {
        $stateName = str_replace('_',' ',$stateName);
        $state = GeoState::find()->where(['LIKE','state', $stateName])->andWhere(['state_code' => $stateCode])->one();
        if ($state === null) {
            throw new \yii\web\NotFoundHttpException(Yii::t('common', 'The page could not be found.'));
        }
        $searchModel = new GeoCityAliasSearch;
        $searchModel->state_id = $state->id;
        $request = \Yii::$app->request;
        $dataProvider = $searchModel->search($request->getQueryParams());
        return $this->render('state',['dataProvider'=>$dataProvider,'searchModel'=>$searchModel, 'state' => $state]);
    }
    
    public function actionCity($cityName)
    {
        $cityName = str_replace('_',' ',$cityName);
        $city = GeoCity::find()->withState()->where(['LIKE','city',$cityName])->andWhere(['state_code'=>'FL'])->one();
        if ($city === null) {
            throw new \yii\web\NotFoundHttpException(Yii::t('common', 'The page could not be found.'));
        }
        return $this->render('city',array('city'=>$city));
    }
    
    public function actionCounty($countyName)
    {
        $countyName = str_replace('_county','',$countyName);
        $countyName = str_replace('_',' ',$countyName);
        $county = GeoCounty::find()->where(['LIKE','county',$countyName])->andWhere(['state_id'=>33])->one();
        if ($county === null) {
            throw new \yii\web\NotFoundHttpException(Yii::t('common', 'The page could not be found.'));
        }
        return $this->render('county',array('county'=>$county));
    }
    
    
    /**
     * Redirect old site urls to new site
     * @param type $cityName
     */
    public function actionRedirect($cityName)
    {
        $cityName = strtolower(str_replace('_','-',$cityName));
        return $this->redirect('/new-mexico/nm/'.$cityName,301);        
    }

}
