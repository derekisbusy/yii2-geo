<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model derekisbusy\geo\models\GeoCountry */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('geo', 'Geo Countries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="geo-country-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('geo', 'Geo Country').' '. Html::encode($this->title) ?></h2>
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
        'country_code',
        'country',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
    
    <div class="row">
<?php
if($providerCannabisBreeder->totalCount){
    $gridColumnCannabisBreeder = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'visible' => false],
            'label',
                        [
                'attribute' => 'state.id',
                'label' => Yii::t('geo', 'State')
            ],
            [
                'attribute' => 'city.id',
                'label' => Yii::t('geo', 'City')
            ],
            'seeds_available',
            'website',
            'description:ntext',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerCannabisBreeder,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-cannabis-breeder']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('geo', 'Cannabis Breeder')),
        ],
        'export' => false,
        'columns' => $gridColumnCannabisBreeder
    ]);
}
?>
    </div>
</div>
