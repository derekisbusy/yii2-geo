<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model vendor\derekisbusy\geo\models\GeoCountry */

$this->title = Yii::t('derekisbusy/geo', 'Update {modelClass}: ', [
    'modelClass' => 'Geo Country',
]) . ' ' . $model->country;
$this->params['breadcrumbs'][] = ['label' => Yii::t('derekisbusy/geo', 'Geo Countries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->country, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('derekisbusy/geo', 'Update');
?>
<div class="geo-country-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
