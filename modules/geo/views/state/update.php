<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model vendor\derekisbusy\geo\models\GeoState */

$this->title = Yii::t('derekisbusy/geo', 'Update {modelClass}: ', [
    'modelClass' => 'Geo State',
]) . ' ' . $model->state;
$this->params['breadcrumbs'][] = ['label' => Yii::t('derekisbusy/geo', 'Geo States'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->state, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('derekisbusy/geo', 'Update');
?>
<div class="geo-state-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
