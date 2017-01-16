<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model derekisbusy\geo\models\GeoCity */

$this->title = $model->city;
$this->params['breadcrumbs'][] = ['label' => Yii::t('geo', 'Cities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="geo-city-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('geo', 'City').' '. Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-3" style="margin-top: 15px">
            
            <?= Html::a(Yii::t('common', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('common', 'Delete'), ['delete', 'id' => $model->id], [
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
        'city',
        [
            'attribute' => 'state.id',
            'label' => Yii::t('geo', 'State'),
        ],
        [
            'attribute' => 'county.id',
            'label' => Yii::t('geo', 'County'),
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
                'attribute' => 'state.id',
                'label' => Yii::t('geo', 'State')
            ],
                ];
    echo Gridview::widget([
        'dataProvider' => $providerGeoZip,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-geo-zip']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('geo', 'Geo Zip')),
        ],
        'export' => false,
        'columns' => $gridColumnGeoZip
    ]);
}
?>
    </div>
</div>