<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model derekisbusy\geo\models\GeoCityAlias */

$this->title = Yii::t('geo', 'Create Geo City Alias');
$this->params['breadcrumbs'][] = ['label' => Yii::t('geo', 'Geo City Aliases'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="geo-city-alias-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
