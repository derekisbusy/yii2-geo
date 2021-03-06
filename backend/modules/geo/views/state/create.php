<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model derekisbusy\geo\models\GeoState */

$this->title = Yii::t('geo', 'Create State');
$this->params['breadcrumbs'][] = ['label' => Yii::t('geo', 'States'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="geo-state-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
