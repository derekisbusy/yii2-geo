<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model derekisbusy\geo\models\GeoZipSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-geo-zip-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'zip')->textInput(['maxlength' => true, 'placeholder' => 'Zip']) ?>

    <?= $form->field($model, 'latitude')->textInput(['placeholder' => 'Latitude']) ?>

    <?= $form->field($model, 'longitude')->textInput(['placeholder' => 'Longitude']) ?>

    <?= $form->field($model, 'county_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\derekisbusy\geo\models\GeoCounty::find()->orderBy('id')->asArray()->all(), 'id', 'id'),
        'options' => ['placeholder' => Yii::t('geo', 'Choose county')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?php /* echo $form->field($model, 'state_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\derekisbusy\geo\models\GeoState::find()->orderBy('id')->asArray()->all(), 'id', 'id'),
        'options' => ['placeholder' => Yii::t('geo', 'Choose Geo state')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); */ ?>

    <?php /* echo $form->field($model, 'city_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\derekisbusy\geo\models\GeoCity::find()->orderBy('id')->asArray()->all(), 'id', 'id'),
        'options' => ['placeholder' => Yii::t('geo', 'Choose Geo city')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); */ ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('common', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('common', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
