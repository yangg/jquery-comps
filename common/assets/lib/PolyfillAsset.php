<?php

namespace common\assets\lib;

use yii\web\AssetBundle;

class PolyfillAsset extends AssetBundle
{
    public $sourcePath = '@static/vendor';
    public $css = [
    ];
    public $jsOptions = ['condition' => 'lte IE 8', 'position' => \yii\web\View::POS_HEAD ];
    public $js = [
        'jquery-legacy.js',
        'ie8-polyfill/html5shiv.js',
        "ie8-polyfill/ie8-polyfill.js",
        "ie8-polyfill/respond.js",
    ];
    public $depends = [
    ];
}
