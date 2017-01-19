<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model derekisbusy\geo\models\GeoZip */

$this->title = Yii::t('geo', 'Create Zip');
$this->params['breadcrumbs'][] = ['label' => Yii::t('geo', 'Geography'), 'url' => ['/geo']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('geo', 'Zips'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="geo-zip-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
