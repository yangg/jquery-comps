<?php

namespace common\assets\vendor;

use yii\web\AssetBundle;

class QrCodeAsset extends AssetBundle
{
    public $sourcePath = '@static';
    public $css = [
    ];
    public $js = [
        'vendor/jquery.qrcode.js',
    ];
    public $depends = [
    ];
}
