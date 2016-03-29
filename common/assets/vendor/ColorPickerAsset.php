<?php

namespace common\assets\vendor;

use yii\web\AssetBundle;

class ColorPickerAsset extends AssetBundle
{
    public $sourcePath = '@static/vendor/simplecolorpicker';
    public $css = [
        'jquery.simplecolorpicker.css'
    ];
    public $js = [
        'jquery.simplecolorpicker.js',
    ];
}
