<?php
namespace derekisbusy\geo\backend\modules\geo\assets;

use yii\web\AssetBundle;


class GeoCountyAsset extends AssetBundle
{
    public $sourcePath = '@derekisbusy/yii2-geo/backend/modules/geo/assets';
    public $css = [
        'css/geo-county-index.css',
    ];
    public $js = [
        'js/geo-county-index.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\grid\GridViewAsset',
        'yii\widgets\PjaxAsset'
    ];
}