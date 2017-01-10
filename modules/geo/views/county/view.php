<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model vendor\derekisbusy\geo\models\GeoCounty */

$this->title = $model->county;
$this->params['breadcrumbs'][] = ['label' => Yii::t('derekisbusy/geo', 'Geo Counties'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="geo-county-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('derekisbusy/geo', 'Geo County').' '. Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-3" style="margin-top: 15px">
            
            <?= Html::a(Yii::t('derekisbusy/geo', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('derekisbusy/geo', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('derekisbusy/geo', 'Are you sure you want to delete this item?'),
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
        'county',
        [
            'attribute' => 'state.id',
            'label' => Yii::t('derekisbusy/geo', 'State'),
        ],
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
                'attribute' => 'state.id',
                'label' => Yii::t('derekisbusy/geo', 'State')
            ],
                ];
    echo Gridview::widget([
        'dataProvider' => $providerGeoCity,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-geo-city']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('derekisbusy/geo', 'Geo City')),
        ],
        'export' => false,
        'columns' => $gridColumnGeoCity
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
                'attribute' => 'state.id',
                'label' => Yii::t('derekisbusy/geo', 'State')
            ],
            [
                'attribute' => 'city.id',
                'label' => Yii::t('derekisbusy/geo', 'City')
            ],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerGeoZip,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-geo-zip']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('derekisbusy/geo', 'Geo Zip')),
        ],
        'export' => false,
        'columns' => $gridColumnGeoZip
    ]);
}
?>
    </div>
</div>
