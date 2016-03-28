<?php

namespace common\assets\lib;

use yii\web\AssetBundle;

class DistrictAsset extends AssetBundle
{
    public $sourcePath = '@static';
    public $css = [
    ];
    public $js = [
        'lib/district.js',
    ];
    public $depends = [
        'common\assets\lib\InterSelectAsset',
        'yii\web\JqueryAsset'
    ];
}
