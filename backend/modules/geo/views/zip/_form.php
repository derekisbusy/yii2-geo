<?php

use derekisbusy\geo\models\GeoCity;
use derekisbusy\geo\models\GeoCounty;
use derekisbusy\geo\models\GeoState;
use derekisbusy\geo\models\GeoZip;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model GeoZip */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="geo-zip-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'zip')->textInput(['maxlength' => true, 'placeholder' => 'Zip']) ?>

    <?= $form->field($model, 'latitude')->textInput(['placeholder' => 'Latitude']) ?>

    <?= $form->field($model, 'longitude')->textInput(['placeholder' => 'Longitude']) ?>


    <?php
//    echo $form->field($model, 'state_id')->widget(\kartik\widgets\Select2::classname(), [
//        'data' => \yii\helpers\ArrayHelper::map(GeoState::find()->orderBy('id')->asArray()->all(), 'id', 'state'),
//        'options' => ['placeholder' => Yii::t('geo', 'Choose state')],
//        'pluginOptions' => [
//            'allowClear' => true
//        ],
//    ]); ?>
    
    <?php
//    echo $form->field($model, 'county_id')->widget(\kartik\widgets\Select2::classname(), [
////        'data' => \yii\helpers\ArrayHelper::map(\derekisbusy\geo\models\GeoCounty::find()->orderBy('id')->asArray()->all(), 'id', 'id'),
//        'options' => ['placeholder' => Yii::t('geo', 'Choose county')],
//        'initValueText' =>  $model->county ? GeoCounty::findOne($model->county_id)->county : '' ,
//        'pluginOptions' => [
//            'allowClear' => true,
//            'minimumInputLength' => 1,
//            'ajax' => [
//                'url' => Url::to(['/geo/ajax/county']),
//                'dataType' => 'json',
//                'data' => new JsExpression('function(params) { return {q:params.term}; }'),
//            ],
//            'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
//            'templateResult' => new JsExpression('function(county) { return county.text; }'),
//            'templateSelection' => new JsExpression('function (county) { return county.text; }'),
//        ],
//    ]); 
    ?>

    <?= $form->field($model, 'city_id')->widget(\kartik\widgets\Select2::classname(), [
//        'data' => \yii\helpers\ArrayHelper::map(\derekisbusy\geo\models\GeoCity::find()->orderBy('id')->asArray()->all(), 'id', 'id'),
        'options' => ['placeholder' => Yii::t('geo', 'Choose city')],
        'initValueText' =>  $model->city_id ? GeoCity::findOne($model->city_id)->city : '' ,
        'pluginOptions' => [
            'allowClear' => true,
            'minimumInputLength' => 1,
            'ajax' => [
                'url' => Url::to(['/geo/ajax/city']),
                'dataType' => 'json',
                'data' => new JsExpression('function(params) { return {q:params.term}; }'),
            ],
            'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
            'templateResult' => new JsExpression('function(city) { return city.text; }'),
            'templateSelection' => new JsExpression('function (city) { return city.text; }'),
        ],
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('common', 'Create') : Yii::t('common', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
