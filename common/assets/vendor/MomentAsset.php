<?php

namespace common\assets\vendor;

use yii\web\AssetBundle;

class MomentAsset extends AssetBundle
{
    public $sourcePath = '@static';
    public $css = [
    ];
    public $js = [
        'vendor/moment.js',
    ];
    public $depends = [
    ];
}
