<?php

namespace derekisbusy\geo\backend\modules\geo\controllers;

use derekisbusy\geo\models\GeoCity;
use derekisbusy\geo\models\GeoCitySearch;
use Yii;
use yii\data\ArrayDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * CityController implements the CRUD actions for GeoCity model.
 */
class CityController extends Controller
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
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'add-geo-zip', 'delete-multiple', 'mark-multiple'],
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
     * Lists all GeoCity models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GeoCitySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single GeoCity model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $providerGeoZip = new ArrayDataProvider([
            'allModels' => $model->geoZips,
        ]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'providerGeoZip' => $providerGeoZip,
        ]);
    }

    /**
     * Creates a new GeoCity model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new GeoCity();

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing GeoCity model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
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
     * Deletes an existing GeoCity model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->deleteWithRelated();

        return $this->redirect(['index']);
    }

    
    /**
     * Finds the GeoCity model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return GeoCity the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GeoCity::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
    }
    
    /**
    * Action to load a tabular form grid
    * for GeoZip
    * @author Yohanes Candrajaya <moo.tensai@gmail.com>
    * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
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
            $i = 0;
            foreach($ids as $id) {
                if ($i % 10 === 0) {
                    $duration += 1000;
                }
                $i++;
                $model = GeoCity::findOne($id);
                if($model === null) {
                    Yii::$app->getSession()->addFlash('growl', [
                        'type' => 'danger',
                        'duration' => $duration,
                        'icon' => 'fa fa-pencil',
                        'title' => 'Failed!',
                        'message' => Yii::t('geo','City ID={id} not found?',['id'=>$id]),
                    ]);
                    continue;
                }
                $cityName = $model->city;
                $model->status = $status;
                if ($model->save()) {
                    Yii::$app->getSession()->addFlash('growl', [
                        'type' => 'success',
                        'options' => ['data-result'=>'success','data-key'=>$id],
                        'duration' => $duration,
                        'icon' => 'fa fa-pencil',
                        'title' => 'Status Updated',
                        'message' => Yii::t('medical','City {city} has been updated', ['city' => $cityName]),
                    ]);
                } else {
                    Yii::$app->getSession()->addFlash('growl', [
                        'type' => 'danger',
                        'options' => ['data-result'=>'success','data-key'=>$id],
                        'duration' => $duration,
                        'icon' => 'fa fa-pencil',
                        'title' => 'Error',
                        'message' => Yii::t('medical','Unabled to update {city}', ['city' => $cityName]),
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
                $model = GeoCity::findOne($id);
                if($model === null) {
                    Yii::$app->getSession()->addFlash('growl', [
                        'type' => 'danger',
                        'duration' => $duration,
                        'icon' => 'fa fa-trash',
                        'title' => 'Failed!',
                        'message' => Yii::t('geo','City ID={id} not found?',['id'=>$id]),
                    ]);
                    continue;
                }
                $stateName = $model->state;
//                $model->delete();
                Yii::$app->getSession()->addFlash('growl', [
                    'type' => 'warning',
                    'options' => ['data-result'=>'success','data-key'=>$id],
                    'duration' => $duration,
                    'icon' => 'fa fa-trash',
                    'title' => 'Deleted',
                    'message' => Yii::t('medical','City {city} has been deleted', ['city' => $stateName]),
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
