<?php

namespace common\assets\vendor;

use yii\web\AssetBundle;

class UploaderAsset extends AssetBundle
{
    public $sourcePath = '@static/vendor/plupload';
    public $css = [
    ];
    public $js = [
        "moxie.js",
        "plupload.dev.js",
    ];
    public $depends = [
    ];
}
