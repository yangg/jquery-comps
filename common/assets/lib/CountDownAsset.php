<?php

namespace common\assets\lib;

use yii\web\AssetBundle;

class CountDownAsset extends AssetBundle
{
    public $sourcePath = '@static';
    public $css = [
    ];
    public $js = [
        'lib/countdown.js',
    ];
    public $depends = [
    ];
}
