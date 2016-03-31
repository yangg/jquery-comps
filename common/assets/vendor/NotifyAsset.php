<?php

namespace common\assets\vendor;

use yii\web\AssetBundle;

class NotifyAsset extends AssetBundle
{
    public $sourcePath = '@static';
    public $css = [
    ];
    public $js = [
        'vendor/notify.js',
    ];
    public $depends = [
    ];
}
