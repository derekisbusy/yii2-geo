<?php
namespace derekisbusy\geo\backend\modules\geo\assets;

use yii\web\AssetBundle;


class GeoCommonAsset extends AssetBundle
{
    public $sourcePath = '@derekisbusy/yii2-geo/backend/modules/geo/assets';
    public $css = [
        'css/common.css',
    ];
    public $js = [
        'js/common.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\grid\GridViewAsset',
        'yii\widgets\PjaxAsset'
    ];
}