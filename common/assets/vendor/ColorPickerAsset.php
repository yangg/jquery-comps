<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

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