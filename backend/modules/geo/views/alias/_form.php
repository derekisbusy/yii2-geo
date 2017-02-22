<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model derekisbusy\geo\models\GeoCityAlias */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="geo-city-alias-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'alias')->textInput(['maxlength' => true, 'placeholder' => 'Alias']) ?>

    <?= $form->field($model, 'city_id')->textInput(['placeholder' => 'City']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('geo', 'Create') : Yii::t('geo', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
