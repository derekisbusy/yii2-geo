<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model vendor\derekisbusy\geo\models\GeoZip */

$this->title = $model->zip;
$this->params['breadcrumbs'][] = ['label' => Yii::t('derekisbusy/geo', 'Geo Zips'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="geo-zip-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('derekisbusy/geo', 'Geo Zip').' '. Html::encode($this->title) ?></h2>
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
        'zip',
        'latitude',
        'longitude',
        [
            'attribute' => 'county.id',
            'label' => Yii::t('derekisbusy/geo', 'County'),
        ],
        [
            'attribute' => 'state.id',
            'label' => Yii::t('derekisbusy/geo', 'State'),
        ],
        [
            'attribute' => 'city.id',
            'label' => Yii::t('derekisbusy/geo', 'City'),
        ],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>
