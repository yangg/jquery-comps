<?php

namespace common\assets\lib;

use yii\web\AssetBundle;

class LetterNavAsset extends AssetBundle
{
    public $sourcePath = '@static';
    public $css = [
    ];
    public $js = [
        'lib/letternav.js',
    ];
    public $depends = [
        'common\assets\lib\CommonAsset',
    ];
}
