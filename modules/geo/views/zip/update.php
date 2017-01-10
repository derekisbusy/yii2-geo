<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model vendor\derekisbusy\geo\models\GeoZip */

$this->title = Yii::t('derekisbusy/geo', 'Update {modelClass}: ', [
    'modelClass' => 'Geo Zip',
]) . ' ' . $model->zip;
$this->params['breadcrumbs'][] = ['label' => Yii::t('derekisbusy/geo', 'Geo Zips'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->zip, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('derekisbusy/geo', 'Update');
?>
<div class="geo-zip-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
