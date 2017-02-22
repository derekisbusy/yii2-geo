<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model derekisbusy\geo\models\GeoState */

$this->title = $model->state;
$this->params['breadcrumbs'][] = ['label' => Yii::t('geo', 'States'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="geo-state-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('geo', 'State').' '. Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-3" style="margin-top: 15px">
            
            <?= Html::a(Yii::t('geo', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('geo', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('geo', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ])
            ?>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'state',
        'state_code',
        'abbr',
        'demonym',
        'adjective',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
    
    <div class="row">
<?php
if($providerGeoCity->totalCount){
    $gridColumnGeoCity = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'visible' => false],
            'city',
                        [
                'attribute' => 'county.id',
                'label' => Yii::t('geo', 'County')
            ],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerGeoCity,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-geo-city']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('geo', 'Cities')),
        ],
        'export' => false,
        'columns' => $gridColumnGeoCity
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerGeoCounty->totalCount){
    $gridColumnGeoCounty = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'visible' => false],
            'county',
                ];
    echo Gridview::widget([
        'dataProvider' => $providerGeoCounty,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-geo-county']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('geo', 'Counties')),
        ],
        'export' => false,
        'columns' => $gridColumnGeoCounty
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerGeoZip->totalCount){
    $gridColumnGeoZip = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'visible' => false],
            'zip',
            'latitude',
            'longitude',
            [
                'attribute' => 'county.id',
                'label' => Yii::t('geo', 'County')
            ],
                        [
                'attribute' => 'city.id',
                'label' => Yii::t('geo', 'City')
            ],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerGeoZip,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-geo-zip']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('geo', 'Zips')),
        ],
        'export' => false,
        'columns' => $gridColumnGeoZip
    ]);
}
?>
    </div>
</div>
