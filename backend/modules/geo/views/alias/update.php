<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model derekisbusy\geo\models\GeoCityAlias */

$this->title = Yii::t('geo', 'Update {modelClass}: ', [
    'modelClass' => 'Geo City Alias',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('geo', 'Geo City Aliases'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('geo', 'Update');
?>
<div class="geo-city-alias-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
