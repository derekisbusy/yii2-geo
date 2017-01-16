<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model vendor\derekisbusy\geo\models\GeoCity */

$this->title = Yii::t('geo', 'Update {modelClass}: ', [
    'modelClass' => 'City',
]) . ' ' . $model->city;
$this->params['breadcrumbs'][] = ['label' => Yii::t('geo', 'Cities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->city, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('geo', 'Update');
?>
<div class="geo-city-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
