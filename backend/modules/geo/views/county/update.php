<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model derekisbusy\geo\models\GeoCounty */

$this->title = Yii::t('geo', 'Update {modelClass}: ', [
    'modelClass' => 'County',
]) . ' ' . $model->county;
$this->params['breadcrumbs'][] = ['label' => Yii::t('geo', 'Geography'), 'url' => ['/geo']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('geo', 'Counties'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->county, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('common', 'Update');
?>
<div class="geo-county-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
