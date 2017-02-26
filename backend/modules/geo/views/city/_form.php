<?php

use derekisbusy\geo\models\GeoCity;
use derekisbusy\geo\models\GeoCounty;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model GeoCity */
/* @var $form yii\widgets\ActiveForm */

\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END, 
    'viewParams' => [
        'class' => 'GeoZip', 
        'relID' => 'geo-zip', 
        'value' => \yii\helpers\Json::encode($model->geoZips),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
?>

<div class="geo-city-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => true, 'placeholder' => 'City']) ?>

    <?php
//    $form->field($model, 'state_id')->widget(\kartik\widgets\Select2::classname(), [
//        'data' => \yii\helpers\ArrayHelper::map(\derekisbusy\geo\models\GeoState::find()->orderBy('id')->asArray()->all(), 'id', 'state'),
//        'options' => ['placeholder' => Yii::t('geo', 'Choose state')],
//        'pluginOptions' => [
//            'allowClear' => true
//        ],
//    ]); ?>

    <?php
    echo $form->field($model, 'county_id')->widget(\kartik\widgets\Select2::classname(), [
//        'data' => \yii\helpers\ArrayHelper::map(\derekisbusy\geo\models\GeoCounty::find()->orderBy('id')->asArray()->all(), 'id', 'id'),
        'options' => ['placeholder' => Yii::t('geo', 'Choose county')],
        'initValueText' =>  $model->county ? GeoCounty::findOne($model->county_id)->county : '' ,
        'pluginOptions' => [
            'allowClear' => true,
            'minimumInputLength' => 1,
            'ajax' => [
                'url' => Url::to(['/geo/ajax/county']),
                'dataType' => 'json',
                'data' => new JsExpression('function(params) { return {q:params.term}; }'),
            ],
            'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
            'templateResult' => new JsExpression('function(county) { return county.text; }'),
            'templateSelection' => new JsExpression('function (county) { return county.text; }'),
        ],
    ]); ?>

    <?php
    $forms = [
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('geo', 'Zip')),
            'content' => $this->render('_formGeoZip', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->geoZips),
            ]),
        ],
    ];
    echo kartik\tabs\TabsX::widget([
        'items' => $forms,
        'position' => kartik\tabs\TabsX::POS_ABOVE,
        'encodeLabels' => false,
        'pluginOptions' => [
            'bordered' => true,
            'sideways' => true,
            'enableCache' => false,
        ],
    ]);
    ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('common', 'Create') : Yii::t('common', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
