<?php

/* @var $this yii\web\View */
/* @var $searchModel derekisbusy\geo\models\GeoCountrySearch */
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

$this->title = Yii::t('geo', 'Geo Countries');
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
    ['attribute' => 'id', 'visible' => false],
    'country_code',
    'country',
    [
        'class' => 'yii\grid\ActionColumn',
    ],
];


echo Html::beginTag('div', ['class'=>'geo-country-index']);
Pjax::begin();
$gridId = 'geo-country-grid';
echo DynaGrid::widget([
    'columns' => $columns,
    'options' => ['id' => 'geo-country-dynagrid'],
    'allowThemeSetting' => false,
    'gridOptions'=>[
        'id' => $gridId,
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'responsive' => true,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-geo-country']],
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
                'columns' => ['id','country_code','country'],
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
            'before' => Html::a('<i class="glyphicon glyphicon-plus"></i> ' . Yii::t('geo', 'New Country'), ['create'], ['class' => 'btn btn-success']), 
            'showFooter' => true,
            'after' => 
                Html::beginTag('div', ['class'=>' pull-left gridview-after-text']) .
                Yii::t('geo', 'With selected: ').
                Html::endTag('div') .
                Html::a('<i class="glyphicon glyphicon-trash"></i> Delete', ['delete-multiple'], [
                    'class' => 'pull-left clear btn btn-danger btn-delete-items',
                    'data-confirm-message' => Yii::t('geo', 'Are you sure you want to delete these {item}?', ['item' => Yii::t('geo', 'countries')]),
                    'data-grid' => $gridId,
                    'data-csrf-param' => yii::$app->request->csrfParam,
                    'data-csrf-token' => yii::$app->request->csrfToken
                ]) .
//                Html::beginTag('div', ['class'=>' pull-left dropdown', 'style' => 'margin-left:20px']) .
//                Html::button('Status <span class="caret"></span></button>', 
//                    ['type'=>'button', 'class'=>'btn btn-default', 'data-toggle'=>'dropdown']) . 
//                DropdownX::widget([
////                    'options'=>['class'=>'pull-right'], // for a right aligned dropdown menu
//                    'items' => [
//                        ['label' => Yii::t('geo','Active'), 'url' => 'javascript:;', 
//                            'linkOptions' => [
//                                'class' => 'btn-update-status',
//                                'data-pjax-container' => '#geo-country-dynagrid-pjax',
//                                'data-url' => Url::toRoute(['mark-multiple']),
//                                'data-status' => GeoCountry::STATUS_ACTIVE,
//                                'data-grid' => $gridId,
//                                'data-csrf-param' => yii::$app->request->csrfParam,
//                                'data-csrf-token' => yii::$app->request->csrfToken
//                            ]
//                        ],
//                        ['label' => Yii::t('geo','Inactive'), 'url' => 'javascript:;', 
//                            'linkOptions' => [
//                                'class' => 'btn-update-status',
//                                'data-pjax-container' => '#geo-city-dynagrid-pjax',
//                                'data-url' => Url::toRoute(['mark-multiple']),
//                                'data-status' => GeoCity::STATUS_INACTIVE,
//                                'data-grid' => $gridId,
//                                'data-csrf-param' => yii::$app->request->csrfParam,
//                                'data-csrf-token' => yii::$app->request->csrfToken
//                            ]
//                        ],
//                        ['label' => Yii::t('geo','Deleted'), 'url' => 'javascript:;', 
//                            'linkOptions' => [
//                                'class' => 'btn-update-status',
//                                'data-pjax-container' => '#geo-city-dynagrid-pjax',
//                                'data-url' => Url::toRoute(['mark-multiple']),
//                                'data-status' => GeoCity::STATUS_DELETED,
//                                'data-grid' => $gridId,
//                                'data-csrf-param' => yii::$app->request->csrfParam,
//                                'data-csrf-token' => yii::$app->request->csrfToken
//                            ]
//                        ],
//                    ],
//                ]) .
//                Html::endTag('div') . 
                Html::beginTag('div', ['class'=>' clearfix']) .
                Html::endTag('div') 
        ],
    ],
]);
Pjax::end();
echo Html::endTag('div');