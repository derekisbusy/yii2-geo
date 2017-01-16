<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model vendor\derekisbusy\geo\models\GeoCity */

$this->title = Yii::t('geo', 'Create City');
$this->params['breadcrumbs'][] = ['label' => Yii::t('geo', 'Cities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="geo-city-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
