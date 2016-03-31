<?php

namespace common\assets\vendor;

use yii\web\AssetBundle;

class ValidatorAsset extends AssetBundle
{
    public $sourcePath = '@static/vendor/nice-validator';
    public $css = [
        'jquery.validator.css'
    ];
    public $js = [
        'jquery.validator.js',
        'local/zh-CN.js',
    ];
    public $depends = [
    ];
}
