<?php

namespace common\assets\lib;

use yii\web\AssetBundle;

class CatTreeAsset extends AssetBundle
{
    public $sourcePath = '@static';
    public $css = [
    ];
    public $js = [
        'lib/cat-tree.js',
    ];
    public $depends = [
        'common\assets\vendor\TreeAsset',
        'common\assets\lib\CommonAsset',
    ];
}
