<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model derekisbusy\geo\models\GeoCityAliasSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-geo-city-alias-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'alias')->textInput(['maxlength' => true, 'placeholder' => 'Alias']) ?>

    <?= $form->field($model, 'city_id')->textInput(['placeholder' => 'City']) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('geo', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('geo', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
