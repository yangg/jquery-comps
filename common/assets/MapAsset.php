<?php

namespace common\assets;

use yii\web\AssetBundle;

class MapAsset extends AssetBundle
{
    public $sourcePath = '@static';
    public $css = [
    ];
    public $js = [
        '//map.qq.com/api/js?v=2.exp',
        'js/jquery.showmap.js',
    ];
    public $depends = [
    ];
}