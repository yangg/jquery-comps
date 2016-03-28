<?php

namespace common\assets\lib;

use yii\web\AssetBundle;

class NumFieldAsset extends AssetBundle
{
    public $sourcePath = '@static';
    public $css = [
    ];
    public $js = [
        'lib/jquery.numfield.js',
    ];
    public $depends = [
    ];
}