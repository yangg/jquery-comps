<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [

            ],
        ],
        'assetManager' => [
            'linkAssets' => true,
            'appendTimestamp' => true,
            'bundles' => [
                'yii\bootstrap\BootstrapAsset' => false,
                'yii\web\JqueryAsset' => [
                    // include my own jquery
//                    'sourcePath'=> '@static/vendor',
                    'jsOptions' => [
                        // put jquery to head
                        'position' => \yii\web\View::POS_HEAD,
                        'condition' => 'gte IE 9 | !IE'
                    ]
                ],
            ],
        ],
    ],
];
