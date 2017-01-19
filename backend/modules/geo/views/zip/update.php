<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model derekisbusy\geo\models\GeoZip */

$this->title = Yii::t('common', 'Update {modelClass}: ', [
    'modelClass' => 'Zip',
]) . ' ' . $model->zip;
$this->params['breadcrumbs'][] = ['label' => Yii::t('geo', 'Geography'), 'url' => ['/geo']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('geo', 'Zips'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->zip, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('common', 'Update');
?>
<div class="geo-zip-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
