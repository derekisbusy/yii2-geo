<div class="form-group" id="add-geo-zip">
<?php

use kartik\builder\TabularForm;
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;
use yii\helpers\Html;

$dataProvider = new ArrayDataProvider([
    'allModels' => $row,
    'pagination' => [
        'pageSize' => -1
    ]
]);
echo TabularForm::widget([
    'dataProvider' => $dataProvider,
    'formName' => 'GeoZip',
    'checkboxColumn' => false,
    'actionColumn' => false,
    'attributeDefaults' => [
        'type' => TabularForm::INPUT_TEXT,
    ],
    'attributes' => [
        "id" => ['type' => TabularForm::INPUT_HIDDEN, 'visible' => false],
        'zip' => ['type' => TabularForm::INPUT_TEXT],
        'latitude' => ['type' => TabularForm::INPUT_TEXT],
        'longitude' => ['type' => TabularForm::INPUT_TEXT],
        'city_id' => [
            'label' => 'City',
            'type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\widgets\Select2::className(),
            'options' => [
                'data' => \yii\helpers\ArrayHelper::map(\derekisbusy\geo\models\GeoCity::find()->orderBy('id')->asArray()->all(), 'id', 'id'),
                'options' => ['placeholder' => Yii::t('geo', 'Choose city')],
            ],
            'columnOptions' => ['width' => '200px']
        ],
        'del' => [
            'type' => 'raw',
            'label' => '',
            'value' => function($model, $key) {
                return Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' =>  Yii::t('common', 'Delete'), 'onClick' => 'delRowGeoZip(' . $key . '); return false;', 'id' => 'geo-zip-del-btn']);
            },
        ],
    ],
    'gridSettings' => [
        'panel' => [
            'heading' => false,
            'type' => GridView::TYPE_DEFAULT,
            'before' => false,
            'footer' => false,
            'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . Yii::t('geo', 'Add Zip'), ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowGeoZip()']),
        ]
    ]
]);
echo  "    </div>\n\n";
?>

