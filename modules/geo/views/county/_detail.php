<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model vendor\derekisbusy\geo\models\GeoCounty */

?>
<div class="geo-county-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Html::encode($model->county) ?></h2>
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
</div>