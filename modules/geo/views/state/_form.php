<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model vendor\derekisbusy\geo\models\GeoState */
/* @var $form yii\widgets\ActiveForm */

\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END, 
    'viewParams' => [
        'class' => 'GeoCity', 
        'relID' => 'geo-city', 
        'value' => \yii\helpers\Json::encode($model->geoCities),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END, 
    'viewParams' => [
        'class' => 'GeoCounty', 
        'relID' => 'geo-county', 
        'value' => \yii\helpers\Json::encode($model->geoCounties),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END, 
    'viewParams' => [
        'class' => 'GeoZip', 
        'relID' => 'geo-zip', 
        'value' => \yii\helpers\Json::encode($model->geoZips),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
?>

<div class="geo-state-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'state')->textInput(['maxlength' => true, 'placeholder' => 'State']) ?>

    <?= $form->field($model, 'state_code')->textInput(['maxlength' => true, 'placeholder' => 'State Code']) ?>

    <?php
    $forms = [
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('derekisbusy/geo', 'GeoCity')),
            'content' => $this->render('_formGeoCity', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->geoCities),
            ]),
        ],
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('derekisbusy/geo', 'GeoCounty')),
            'content' => $this->render('_formGeoCounty', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->geoCounties),
            ]),
        ],
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('derekisbusy/geo', 'GeoZip')),
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
        <?= Html::submitButton($model->isNewRecord ? Yii::t('derekisbusy/geo', 'Create') : Yii::t('derekisbusy/geo', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
