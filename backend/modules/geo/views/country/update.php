<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model derekisbusy\geo\models\GeoCountry */

$this->title = Yii::t('geo', 'Update {modelClass}: ', [
    'modelClass' => 'Geo Country',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('geo', 'Geo Countries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('geo', 'Update');
?>
<div class="geo-country-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
