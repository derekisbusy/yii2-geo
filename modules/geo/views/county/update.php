<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model vendor\derekisbusy\geo\models\GeoCounty */

$this->title = Yii::t('derekisbusy/geo', 'Update {modelClass}: ', [
    'modelClass' => 'Geo County',
]) . ' ' . $model->county;
$this->params['breadcrumbs'][] = ['label' => Yii::t('derekisbusy/geo', 'Geo Counties'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->county, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('derekisbusy/geo', 'Update');
?>
<div class="geo-county-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
