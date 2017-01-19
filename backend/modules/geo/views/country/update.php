<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model vendor\derekisbusy\geo\models\GeoCountry */

$this->title = Yii::t('geo', 'Update {modelClass}: ', [
    'modelClass' => 'Country',
]) . ' ' . $model->country;
$this->params['breadcrumbs'][] = ['label' => Yii::t('geo', 'Countries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->country, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('common', 'Update');
?>
<div class="geo-country-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
