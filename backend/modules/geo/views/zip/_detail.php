<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model derekisbusy\geo\models\GeoZip */

?>
<div class="geo-zip-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Html::encode($model->zip) ?></h2>
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
            'label' => Yii::t('geo', 'County'),
        ],
        [
            'attribute' => 'state.id',
            'label' => Yii::t('geo', 'State'),
        ],
        [
            'attribute' => 'city.id',
            'label' => Yii::t('geo', 'City'),
        ],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>