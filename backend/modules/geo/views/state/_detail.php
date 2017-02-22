<?php

use derekisbusy\geo\models\GeoState;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model GeoState */

?>
<div class="geo-state-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Html::encode($model->state) ?></h2>
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
</div>