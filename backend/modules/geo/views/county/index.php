<?php

/* @var $this yii\web\View */
/* @var $searchModel GeoCountySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use derekisbusy\geo\backend\modules\geo\assets\GeoCountyAsset;
use derekisbusy\geo\models\GeoCounty;
use derekisbusy\geo\models\GeoCountySearch;
use derekisbusy\geo\models\GeoState;
use kartik\dropdown\DropdownX;
use kartik\dynagrid\DynaGrid;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

GeoCountyAsset::register($this);

$this->title = Yii::t('geo', 'Counties');
$this->params['breadcrumbs'][] = ['label' => Yii::t('geo', 'Geography'), 'url' => ['/geo']];
$this->params['breadcrumbs'][] = $this->title;
$search = "$('.search-button').click(function(){
	$('.search-form').toggle(1000);
	return false;
});";
$this->registerJs($search);

echo  \derekisbusy\growl\FlashGrowlWidget::widget();

$columns = [
    [
        'class'=>'kartik\grid\CheckboxColumn',
        'headerOptions'=>['class'=>'kartik-sheet-style'],
    ],
    [
        'class' => 'yii\grid\SerialColumn'
        , 'visible' => false
    ],
    [
        'class' => 'kartik\grid\ExpandRowColumn',
        'width' => '50px',
        'value' => function ($model, $key, $index, $column) {
            return GridView::ROW_COLLAPSED;
        },
        'detail' => function ($model, $key, $index, $column) {
            return Yii::$app->controller->renderPartial('_expand', ['model' => $model]);
        },
        'headerOptions' => ['class' => 'kartik-sheet-style'],
        'expandOneOnly' => true
    ],
    ['attribute' => 'id', 'visible' => false],
    'county',
    [
        'attribute' => 'state',
        'value' => 'state.state',
        'label' => Yii::t('geo', 'State'),
//            'value' => function($model){
//                return $model->state->id;
//            },
        'filterType' => GridView::FILTER_SELECT2,
        'filter' => \yii\helpers\ArrayHelper::map(GeoState::find()->asArray()->all(), 'id', 'state'),
        'filterWidgetOptions' => [
            'pluginOptions' => ['allowClear' => true],
        ],
        'filterInputOptions' => ['placeholder' => 'State', 'id' => 'grid-geo-county-search-state_id']
    ],
    [
        'attribute' => 'status',
        'value' => function($model){
            return '<span class="label label-'.GeoCounty::getStatusLabelTypes()[$model->status].'">' . GeoCounty::getStatusOptions()[$model->status] . '</span>';
        },
        'format' => 'raw',
        'filterType' => GridView::FILTER_SELECT2,
        'filter' => GeoCounty::getStatusOptions(),
        'filterWidgetOptions' => [
            'pluginOptions' => ['allowClear' => true],
        ],
        'filterInputOptions' => ['placeholder' => 'Status', 'id' => 'grid-geo-county-search-status']
    ],
    [
        'class' => 'yii\grid\ActionColumn',
    ],
]; 

            
echo Html::beginTag('div', ['class'=>'geo-county-index']);
            
Pjax::begin();
$gridId = 'geo-county-grid';
echo DynaGrid::widget([
    'columns' => $columns,
    'options' => ['id' => 'geo-county-dynagrid'],
    'allowThemeSetting' => false,
    'gridOptions'=>[
        'id' => $gridId,
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'responsive' => true,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-geo-county']],
        'hover' => true,
        'condensed' => true,
        'floatHeader' => true,
        'floatHeaderOptions' => [
            'position' => 'absolute'
        ],
        'resizableColumns' => true,
        'resizableColumnsOptions' => ['resizeFromBody' => true],
        'persistResize' => true,
        'hideResizeMobile' => true,
        'toolbar' => [
            [
                'content' => 
                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], [
                        'class' => 'btn btn-default', 
                        'title' => Yii::t('backend', 'Reset')
                    ]),
            ],
            '{dynagrid}',
            '{dynagridFilter}',
            '{dynagridSort}',
            '{export}',
            ExportMenu::widget([
                'dataProvider' => $dataProvider,
                'columns' => ['id','county','state_id'],
                'target' => ExportMenu::TARGET_BLANK,
                'fontAwesome' => true,
                'dropdownOptions' => [
                    'label' => 'Full',
                    'class' => 'btn btn-default',
                    'itemsBefore' => [
                        '<li class="dropdown-header">Export All Data</li>',
                    ],
                ],
                'exportConfig' => [
                    ExportMenu::FORMAT_PDF => false
                ]
            ]),
            '{toggleData}'
        ],
        'panel' => [
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-th-list"></i> ' . Html::encode($this->title) . ' </h3>',
            'type' => 'info',
            'before' => Html::a('<i class="glyphicon glyphicon-plus"></i> ' . Yii::t('geo', 'New County'), ['create'], ['class' => 'btn btn-success']), 'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset List', ['index'], ['class' => 'btn btn-info']),
            'showFooter' => true,
            'after' => 
                Html::beginTag('div', ['class'=>' pull-left gridview-after-text']) .
                Yii::t('geo', 'With selected: ').
                Html::endTag('div') .
                Html::a('<i class="glyphicon glyphicon-trash"></i> Delete', ['delete-multiple'], [
                    'class' => 'pull-left clear btn btn-danger btn-delete-geo-counties',
                    'data-confirm-message' => Yii::t('medical', 'Are you sure you want to delete these ' . Yii::t('medical', 'counties') . '?'),
                    'data-grid' => $gridId,
                    'data-csrf-param' => yii::$app->request->csrfParam,
                    'data-csrf-token' => yii::$app->request->csrfToken
                ]) .
                Html::beginTag('div', ['class'=>' pull-left dropdown', 'style' => 'margin-left:20px']) .
                Html::button('Status <span class="caret"></span></button>', 
                    ['type'=>'button', 'class'=>'btn btn-default', 'data-toggle'=>'dropdown']) . 
                DropdownX::widget([
//                    'options'=>['class'=>'pull-right'], // for a right aligned dropdown menu
                    'items' => [
                        ['label' => Yii::t('geo','Active'), 'url' => 'javascript://', 
                            'linkOptions' => [
                                'class' => 'btn-update-status-geo-counties',
                                'data-pjax' => false,
                                'data-url' => Url::toRoute(['mark-multiple']),
                                'data-status' => GeoCounty::STATUS_ACTIVE,
                                'data-grid' => $gridId,
                                'data-csrf-param' => yii::$app->request->csrfParam,
                                'data-csrf-token' => yii::$app->request->csrfToken
                            ]
                        ],
                        ['label' => Yii::t('geo','Inactive'), 'url' => 'javascript:;', 
                            'linkOptions' => [
                                'class' => 'btn-update-status-geo-counties',
                                'data-url' => Url::toRoute(['mark-multiple']),
                                'data-status' => GeoCounty::STATUS_INACTIVE,
                                'data-grid' => $gridId,
                                'data-csrf-param' => yii::$app->request->csrfParam,
                                'data-csrf-token' => yii::$app->request->csrfToken
                            ]
                        ],
                        ['label' => Yii::t('geo','Deleted'), 'url' => 'javascript:;', 
                            'linkOptions' => [
                                'class' => 'btn-update-status-geo-counties',
                                'data-url' => Url::toRoute(['mark-multiple']),
                                'data-status' => GeoCounty::STATUS_DELETED,
                                'data-grid' => $gridId,
                                'data-csrf-param' => yii::$app->request->csrfParam,
                                'data-csrf-token' => yii::$app->request->csrfToken
                            ]
                        ],
                    ],
                ]) .
                Html::endTag('div') . 
                Html::beginTag('div', ['class'=>' clearfix']) .
                Html::endTag('div') 
        ],
    ],
]);
Pjax::end();
echo Html::endTag('div');