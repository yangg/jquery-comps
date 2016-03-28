<?php

namespace common\assets\vendor;

use yii\web\AssetBundle;

class EditorAsset extends AssetBundle
{
    public $sourcePath = '@static/vendor/ueditor';
    public $css = [
    ];
    public $js = [
        "ueditor.config.js",
        "ueditor.all.js",
        "lang/zh-cn/zh-cn.js",
    ];
    public $depends = [
    ];
}