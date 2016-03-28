<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace common\assets\vendor;

use yii\web\AssetBundle;

class ValidatorAsset extends AssetBundle
{
    public $sourcePath = '@static/vendor/nice-validator';
    public $css = [
        'jquery.validator.css'
    ];
    public $js = [
        'jquery.validator.js',
        'local/zh-CN.js',
    ];
}