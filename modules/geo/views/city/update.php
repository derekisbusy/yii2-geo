<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model vendor\derekisbusy\geo\models\GeoCity */

$this->title = Yii::t('derekisbusy/geo', 'Update {modelClass}: ', [
    'modelClass' => 'Geo City',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('derekisbusy/geo', 'Geo Cities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('derekisbusy/geo', 'Update');
?>
<div class="geo-city-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
