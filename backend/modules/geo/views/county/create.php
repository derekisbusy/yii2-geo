<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model derekisbusy\geo\models\GeoCounty */

$this->title = Yii::t('geo', 'Create County');
$this->params['breadcrumbs'][] = ['label' => Yii::t('geo', 'Geography'), 'url' => ['/geo']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('geo', 'Geo Counties'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="geo-county-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
