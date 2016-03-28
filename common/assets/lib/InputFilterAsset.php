<?php

namespace common\assets\lib;

use yii\web\AssetBundle;

class InputFilterAsset extends AssetBundle
{
    public $sourcePath = '@static';
    public $css = [
    ];
    public $js = [
        'lib/inputfilter.js',
    ];
    public $depends = [
    ];
}