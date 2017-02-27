<?php

/* @var $this yii\web\View */
/* @var $searchModel GeoCitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use derekisbusy\geo\backend\modules\geo\assets\GeoCommonAsset;
use derekisbusy\geo\models\GeoCity;
use derekisbusy\geo\models\GeoCitySearch;
use derekisbusy\geo\models\GeoState;
use kartik\dropdown\DropdownX;
use kartik\dynagrid\DynaGrid;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\widgets\Pjax;

GeoCommonAsset::register($this);

$this->title = Yii::t('geo', 'Cities');
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
        'class' => 'yii\grid\SerialColumn',
        'visible' => false
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
    'city',
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
        'filterInputOptions' => ['placeholder' => 'State', 'id' => 'grid-geo-city-search-state_id']
    ],
    [
        'attribute' => 'county',
        'label' => Yii::t('geo', 'County'),
        'value' => function($model){
            return $model->county;
        },
        'filterType' => GridView::FILTER_SELECT2,
        'filterWidgetOptions' => [
            'initValueText' =>  $searchModel->county ? \derekisbusy\geo\models\GeoCounty::findOne($searchModel->county)->county : '' ,
            'pluginOptions' => [
                'allowClear' => true,
                'minimumInputLength' => $searchModel->state ? 0 : 1,
                'ajax' => [
                    'url' => Url::to(['/geo/ajax/county?state='.$searchModel->state]),
                    'dataType' => 'json',
                    'data' => new JsExpression('function(params) { return {q:params.term}; }'),
                ],
                'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                'templateResult' => new JsExpression('function(county) { return county.text; }'),
                'templateSelection' => new JsExpression('function (county) { return county.text; }'),
            ],
        ],
        'filterInputOptions' => ['placeholder' => 'county', 'id' => 'grid-geo-city-search-county_id']
    ],
    [
        'attribute' => 'status',
        'value' => function($model){
            return '<span class="label label-'.GeoCity::getStatusLabelTypes()[$model->status].'">' . GeoCity::getStatusOptions()[$model->status] . '</span>';
        },
        'format' => 'raw',
        'filterType' => GridView::FILTER_SELECT2,
        'filter' => GeoCity::getStatusOptions(),
        'filterWidgetOptions' => [
            'pluginOptions' => ['allowClear' => true],
        ],
        'filterInputOptions' => ['placeholder' => 'Status', 'id' => 'grid-geo-city-search-status']
    ],
    [
        'class' => 'yii\grid\ActionColumn',
    ],
]; 


echo Html::beginTag('div', ['class'=>'geo-city-index']);
$gridId = 'geo-city-grid';
echo DynaGrid::widget([
    'columns' => $columns,
    'options' => ['id' => 'geo-city-dynagrid'],
    'allowThemeSetting' => false,
    'gridOptions'=>[
        'id' => $gridId,
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'responsive' => true,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-geo-city']],
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
                'columns' => ['id','city','state_id', 'county_id'],
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
            'before' => Html::a('<i class="glyphicon glyphicon-plus"></i> ' . Yii::t('geo', 'New City'), ['create'], ['class' => 'btn btn-success']), 
            'showFooter' => true,
            'after' => 
                Html::beginTag('div', ['class'=>' pull-left gridview-after-text']) .
                Yii::t('geo', 'With selected: ').
                Html::endTag('div') .
                Html::a('<i class="glyphicon glyphicon-trash"></i> Delete', ['delete-multiple'], [
                    'class' => 'pull-left clear btn btn-danger btn-delete-items',
                    'data-confirm-message' => Yii::t('geo', 'Are you sure you want to delete these {item}?', ['item' => Yii::t('geo', 'cities')]),
                    'data-grid' => $gridId,
                    'data-csrf-param' => yii::$app->request->csrfParam,
                    'data-csrf-token' => yii::$app->request->csrfToken
                ]) .
                Html::beginTag('div', ['class'=>' pull-left dropdown', 'style' => 'margin-left:20px']) .
                Html::button('Status <span class="caret"></span></button>', 
                    ['type'=>'button', 'class'=>'btn btn-default', 'data-toggle'=>'dropdown']) . 
                DropdownX::widget([
                    'items' => [
                        ['label' => Yii::t('geo','Active'), 'url' => 'javascript:;', 
                            'linkOptions' => [
                                'class' => 'btn-update-status',
                                'data-pjax-container' => '#geo-city-dynagrid-pjax',
                                'data-url' => Url::toRoute(['mark-multiple']),
                                'data-status' => GeoCity::STATUS_ACTIVE,
                                'data-grid' => $gridId,
                                'data-csrf-param' => yii::$app->request->csrfParam,
                                'data-csrf-token' => yii::$app->request->csrfToken
                            ]
                        ],
                        ['label' => Yii::t('geo','Inactive'), 'url' => 'javascript:;', 
                            'linkOptions' => [
                                'class' => 'btn-update-status',
                                'data-pjax-container' => '#geo-city-dynagrid-pjax',
                                'data-url' => Url::toRoute(['mark-multiple']),
                                'data-status' => GeoCity::STATUS_INACTIVE,
                                'data-grid' => $gridId,
                                'data-csrf-param' => yii::$app->request->csrfParam,
                                'data-csrf-token' => yii::$app->request->csrfToken
                            ]
                        ],
                        ['label' => Yii::t('geo','Deleted'), 'url' => 'javascript:;', 
                            'linkOptions' => [
                                'class' => 'btn-update-status',
                                'data-pjax-container' => '#geo-city-dynagrid-pjax',
                                'data-url' => Url::toRoute(['mark-multiple']),
                                'data-status' => GeoCity::STATUS_DELETED,
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
echo Html::endTag('div');