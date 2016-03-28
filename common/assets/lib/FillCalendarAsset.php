<?php

namespace common\assets\lib;

use yii\web\AssetBundle;

class FillCalendarAsset extends AssetBundle
{
    public $sourcePath = '@static';
    public $css = [
    ];
    public $js = [
        'lib/fill-calendar.js',
    ];
    public $depends = [
    ];
}