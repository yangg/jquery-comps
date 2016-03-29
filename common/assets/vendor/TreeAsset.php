<?php

namespace common\assets\vendor;

use yii\web\AssetBundle;

class TreeAsset extends AssetBundle
{
    public $sourcePath = '@static/vendor/jstree';
    public $css = [
        'themes/default/style.css',
    ];
    public $js = [
        'jstree.js',
    ];
}
