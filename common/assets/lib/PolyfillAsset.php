<?php

namespace common\assets\lib;

use yii\web\AssetBundle;

class PolyfillAsset extends AssetBundle
{
    public $sourcePath = '@static/vendor/ie8-polyfill';
    public $css = [
    ];
    public $jsOptions = ['condition' => 'lte IE 8', 'position' => \yii\web\View::POS_HEAD ];
    public $js = [
        "ie8-polyfill.js",
        "respond.js",
    ];
    public $depends = [
    ];
}
