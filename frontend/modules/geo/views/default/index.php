<?php

use kartik\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

$gridColumns = [
    [
        'attribute'=>'state',
        'format'=>'raw',
        'value'=>function($model, $key, $index, $column) {
            $l=strtolower(str_replace(' ', '_', $model->state));
            return '<a href="'.\yii\helpers\Url::to('/geo/default/state/'.$l).'">'.$model->state.'</a>';
        }
    ],
    [
        'attribute'=>'state_code',
        'format'=>'raw',
        'value'=>function($model, $key, $index, $column) {
            return '<a href="'.\yii\helpers\Url::to('/geo/default/state/'.$model->state_code).'">'.$model->state_code.'</a>';
        }
    ]
];
Html::beginTag('div', ['class'=>'state']);
//Pjax::begin();
echo GridView::widget([
    'dataProvider'=>$dataProvider,
    'filterModel'=>$searchModel,
    'columns'=>$gridColumns,
    'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
    'headerRowOptions'=>['class'=>'kartik-sheet-style'],
//    'filterRowOptions'=>['class'=>'kartik-sheet-style'],
    'pjax'=>true,
//    'beforeHeader'=>[
//        [
//            'columns'=>[
//                ['content'=>'Header Before 1', 'options'=>['colspan'=>5, 'class'=>'text-center warning']], 
//                ['content'=>'Header Before 2', 'options'=>['colspan'=>3, 'class'=>'text-center warning']], 
//                ['content'=>'Header Before 3', 'options'=>['colspan'=>3, 'class'=>'text-center warning']], 
//            ],
//            'options'=>['class'=>'skip-export'] // remove this row from export
//        ]
//    ],
    // set your toolbar
    'toolbar'=>null,
//    'toolbar'=> [
//        ['content'=>
//            Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type'=>'button', 'title'=>Yii::t('kvgrid', 'Add Book'), 'class'=>'btn btn-success', 'onclick'=>'alert("This will launch the book creation form.\n\nDisabled for this demo!");']) . ' '.
//            Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['grid-demo'], ['data-pjax'=>0, 'class'=>'btn btn-default', 'title'=>Yii::t('kvgrid', 'Reset Grid')])
//        ],
//        '{export}',
//        '{toggleData}',
//    ],
    // set export properties
//    'export'=>[
//        'fontAwesome'=>true
//    ],
    // parameters from the demo form
    'bordered'=>true,
    'striped'=>true,
    'condensed'=>true,
    'responsive'=>true,
    'hover'=>true,
//    'panelTemplate'=>'{panelHeading}
//    {panelBefore}{pager}
//    {items}
//    {panelAfter}
//    {panelFooter}',
    'panel'=>[
        'type'=>GridView::TYPE_DEFAULT,
        'heading'=>Yii::t('geo','States'),
    ],
    'persistResize'=>false,
//    'exportConfig'=>$exportConfig,
]);
//Pjax::end();
Html::endTag('div');
