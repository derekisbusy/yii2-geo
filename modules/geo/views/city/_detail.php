<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model vendor\derekisbusy\geo\models\GeoCity */

?>
<div class="geo-city-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Html::encode($model->id) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'city',
        [
            'attribute' => 'state.id',
            'label' => Yii::t('derekisbusy/geo', 'State'),
        ],
        [
            'attribute' => 'county.id',
            'label' => Yii::t('derekisbusy/geo', 'County'),
        ],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>