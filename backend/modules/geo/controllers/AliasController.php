<?php

namespace derekisbusy\geo\backend\modules\geo\controllers;

use derekisbusy\geo\models\GeoCityAlias;
use derekisbusy\geo\models\GeoCityAliasSearch;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * AliasController implements the CRUD actions for GeoCityAlias model.
 */
class AliasController extends Controller
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
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'delete-multiple', 'mark-multiple'],
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
     * Lists all GeoCityAlias models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GeoCityAliasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single GeoCityAlias model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new GeoCityAlias model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new GeoCityAlias();

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing GeoCityAlias model.
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
     * Deletes an existing GeoCityAlias model.
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
     * Finds the GeoCityAlias model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return GeoCityAlias the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GeoCityAlias::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('geo', 'The requested page does not exist.'));
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
                $model = GeoCityAlias::findOne($id);
                if($model === null) {
                    Yii::$app->getSession()->addFlash('growl', [
                        'type' => 'danger',
                        'duration' => $duration,
                        'icon' => 'fa fa-pencil',
                        'title' => 'Failed!',
                        'message' => Yii::t('geo','Alias ID={id} not found?',['id' => $id]),
                    ]);
                    continue;
                }
                $aliasName = $model->alias;
                $model->status = $status;
                if ($model->save()) {
                    Yii::$app->getSession()->addFlash('growl', [
                        'type' => 'success',
                        'options' => ['data-result'=>'success','data-key' => $id],
                        'duration' => $duration,
                        'icon' => 'fa fa-pencil',
                        'title' => 'Status Updated',
                        'message' => Yii::t('medical','Alias {alias} has been updated', ['alias' => $aliasName]),
                    ]);
                } else {
                    Yii::$app->getSession()->addFlash('growl', [
                        'type' => 'danger',
                        'options' => ['data-result'=>'success','data-key'=>$id],
                        'duration' => $duration,
                        'icon' => 'fa fa-pencil',
                        'title' => 'Error',
                        'message' => Yii::t('medical','Unabled to update {alias}', ['alias' => $aliasName]),
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
                $model = GeoCityAlias::findOne($id);
                if($model === null) {
                    Yii::$app->getSession()->addFlash('growl', [
                        'type' => 'danger',
                        'duration' => $duration,
                        'icon' => 'fa fa-trash',
                        'title' => 'Failed!',
                        'message' => Yii::t('geo','Alias ID={id} not found?',['id'=>$id]),
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
                    'message' => Yii::t('medical','Alias {alias} has been deleted', ['alias' => $stateName]),
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
