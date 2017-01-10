<?php
use yii\helpers\Html;
use kartik\tabs\TabsX;
use yii\helpers\Url;
$items = [
    [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode(Yii::t('derekisbusy/geo', 'GeoState')),
        'content' => $this->render('_detail', [
            'model' => $model,
        ]),
    ],
        [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode(Yii::t('derekisbusy/geo', 'Geo City')),
        'content' => $this->render('_dataGeoCity', [
            'model' => $model,
            'row' => $model->geoCities,
        ]),
    ],
            [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode(Yii::t('derekisbusy/geo', 'Geo County')),
        'content' => $this->render('_dataGeoCounty', [
            'model' => $model,
            'row' => $model->geoCounties,
        ]),
    ],
            [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode(Yii::t('derekisbusy/geo', 'Geo Zip')),
        'content' => $this->render('_dataGeoZip', [
            'model' => $model,
            'row' => $model->geoZips,
        ]),
    ],
    ];
echo TabsX::widget([
    'items' => $items,
    'position' => TabsX::POS_ABOVE,
    'encodeLabels' => false,
    'class' => 'tes',
    'pluginOptions' => [
        'bordered' => true,
        'sideways' => true,
        'enableCache' => false
    ],
]);
?>
