<?php

namespace common\assets\lib;

use yii\web\AssetBundle;

class InterSelectAsset extends AssetBundle
{
    public $sourcePath = '@static';
    public $css = [
    ];
    public $js = [
        'lib/interselect.js',
    ];
    public $depends = [
        'common\assets\lib\CommonAsset',
    ];
}
