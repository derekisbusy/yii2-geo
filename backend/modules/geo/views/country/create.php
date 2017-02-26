<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model derekisbusy\geo\models\GeoCountry */

$this->title = Yii::t('geo', 'Create Geo Country');
$this->params['breadcrumbs'][] = ['label' => Yii::t('geo', 'Geo Countries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="geo-country-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
