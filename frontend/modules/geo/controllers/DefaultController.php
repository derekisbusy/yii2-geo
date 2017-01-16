<?php

namespace derekisbusy\geo\frontend\modules\geo\controllers;

use yii\web\Controller;

/**
 * Default controller for the `geo` module
 */
class DefaultController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new \derekisbusy\geo\models\GeoCitySearch;
        $searchModel->state_id = 10;
        $dataProvider = $searchModel->search(\Yii::$app->request->getQueryParams());
        return $this->render('index',['dataProvider'=>$dataProvider,'searchModel'=>$searchModel]);
    }
    
    public function actionCity($cityName)
    {
        $this->cssSuffix = 'geo-doctor';
        $cityName = str_replace('_',' ',$cityName);
        $city = \derekisbusy\geo\models\GeoCity::find()->where(['LIKE','city',$cityName])->andWhere(['state_code'=>'NM'])->one();
        if($city===null)
            throw new \yii\web\NotFoundHttpException(Yii::t('common','The page could not be found.'));
        return $this->render('city',array('city'=>$city));
    }
    
    public function actionCounty($countyName)
    {
        $this->cssSuffix = 'geo-doctor';
        $countyName = str_replace('_county','',$countyName);
        $countyName = str_replace('_',' ',$countyName);
        $county = \derekisbusy\geo\models\GeoCounty::find()->where(['LIKE','county',$countyName])->andWhere(['state_id'=>33])->one();
        if($county===null)
            throw new \yii\web\NotFoundHttpException(Yii::t('common','The page could not be found.'));
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
