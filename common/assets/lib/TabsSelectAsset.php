<?php

namespace common\assets\lib;

use yii\web\AssetBundle;

class TabsSelectAsset extends AssetBundle
{
    public $sourcePath = '@static';
    public $css = [
    ];
    public $js = [
        'lib/tabs-select.js',
    ];
    public $depends = [
        'common\assets\lib\CommonAsset',
    ];
}
