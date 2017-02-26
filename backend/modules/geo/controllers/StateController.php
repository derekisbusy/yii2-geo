<?php

namespace derekisbusy\geo\backend\modules\geo\controllers;

use Yii;
use derekisbusy\geo\models\GeoState;
use derekisbusy\geo\models\GeoStateSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StateController implements the CRUD actions for GeoState model.
 */
class StateController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'add-geo-city', 'add-geo-county', 'add-geo-zip', 'delete-multiple', 'mark-multiple'],
                        'roles' => ['@']
                    ],
                    [
                        'allow' => false
                    ]
                ]
            ]
        ];
    }

    /**
     * Lists all GeoState models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GeoStateSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single GeoState model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $providerGeoCity = new \yii\data\ArrayDataProvider([
            'allModels' => $model->geoCities,
        ]);
        $providerGeoCounty = new \yii\data\ArrayDataProvider([
            'allModels' => $model->geoCounties,
        ]);
        $providerGeoZip = new \yii\data\ArrayDataProvider([
            'allModels' => $model->geoZips,
        ]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'providerGeoCity' => $providerGeoCity,
            'providerGeoCounty' => $providerGeoCounty,
            'providerGeoZip' => $providerGeoZip,
        ]);
    }

    /**
     * Creates a new GeoState model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new GeoState();

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing GeoState model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing GeoState model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->deleteWithRelated();

        return $this->redirect(['index']);
    }

    
    /**
     * Finds the GeoState model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return GeoState the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GeoState::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
    }
    
    /**
    * Action to load a tabular form grid
    * for GeoCity
    *
    * @return mixed
    */
    public function actionAddGeoCity()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('GeoCity');
            if((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formGeoCity', ['row' => $row]);
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
    }
    
    /**
    * Action to load a tabular form grid
    * for GeoCounty
    *
    * @return mixed
    */
    public function actionAddGeoCounty()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('GeoCounty');
            if((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formGeoCounty', ['row' => $row]);
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
    }
    
    /**
    * Action to load a tabular form grid
    * for GeoZip
    *
    * @return mixed
    */
    public function actionAddGeoZip()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('GeoZip');
            if((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formGeoZip', ['row' => $row]);
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
    }
    
    /**
     * @param array $ids
     * @param integer $status
     * @return mixed
     */
    public function actionMarkMultiple()
    {
        $ids = Yii::$app->request->post('ids');
        $status = Yii::$app->request->post('status');
        
        if(!is_array($ids) || empty($ids)) {
            Yii::$app->getSession()->addFlash('growl', [
                'type' => 'danger',
                'duration' => 5000,
                'icon' => 'fa fa-trash',
                'title' => 'Failed!',
                'message' => 'No IDs were sent?',
            ]);
        } else {
            $duration = 1500;
            foreach($ids as $id) {
                $duration += 1000;
                $model = GeoState::findOne($id);
                if($model === null) {
                    Yii::$app->getSession()->addFlash('growl', [
                        'type' => 'danger',
                        'duration' => $duration,
                        'icon' => 'fa fa-pencil',
                        'title' => 'Failed!',
                        'message' => Yii::t('geo','State ID={id} not found?',['id'=>$id]),
                    ]);
                    continue;
                }
                $stateName = $model->state;
                $model->status = $status;
                if ($model->save()) {
                    Yii::$app->getSession()->addFlash('growl', [
                        'type' => 'success',
                        'options' => ['data-result'=>'success','data-key'=>$id],
                        'duration' => $duration,
                        'icon' => 'fa fa-pencil',
                        'title' => 'Status Updated',
                        'message' => Yii::t('medical','State {state} has been updated', ['state' => $stateName]),
                    ]);
                } else {
                    Yii::$app->getSession()->addFlash('growl', [
                        'type' => 'danger',
                        'options' => ['data-result'=>'success','data-key'=>$id],
                        'duration' => $duration,
                        'icon' => 'fa fa-pencil',
                        'title' => 'Error',
                        'message' => Yii::t('medical','Unabled to update {state}', ['state' => $stateName]),
                    ]);
                }
            }
        }
        
        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('@derekisbusy/yii2-flash-growl/_growl');
        } else {
            return $this->actionIndex();
        }
    }
    
    /**
     * @param array $ids
     * @return mixed
     */
    public function actionDeleteMultiple()
    {

        $ids = Yii::$app->request->post('ids');
        if(!is_array($ids) || empty($ids)) {
            Yii::$app->getSession()->addFlash('growl', [
                'type' => 'danger',
                'duration' => 5000,
                'icon' => 'fa fa-trash',
                'title' => 'Failed!',
                'message' => 'No IDs were sent?',
            ]);
        }
        else {
            $duration = 1500;
            foreach($ids as $id) {
                $duration += 500;
                $model = GeoState::findOne($id);
                if($model === null) {
                    Yii::$app->getSession()->addFlash('growl', [
                        'type' => 'danger',
                        'duration' => $duration,
                        'icon' => 'fa fa-trash',
                        'title' => 'Failed!',
                        'message' => Yii::t('geo','State ID={id} not found?',['id'=>$id]),
                    ]);
                    continue;
                }
                $stateName = $model->state;
                $model->delete();
                Yii::$app->getSession()->addFlash('growl', [
                    'type' => 'warning',
                    'options' => ['data-result'=>'success','data-key'=>$id],
                    'duration' => $duration,
                    'icon' => 'fa fa-trash',
                    'title' => 'Deleted',
                    'message' => Yii::t('medical','State {state} has been deleted', ['state' => $stateName]),
                ]);
            }
        }
        
        if (Yii::$app->request->isAjax || true) {
            return $this->renderAjax('@derekisbusy/yii2-flash-growl/_growl');
        } else {
            return $this->actionIndex();
        }
    }
}
