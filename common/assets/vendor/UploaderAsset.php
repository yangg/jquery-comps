<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace common\assets\vendor;

use yii\web\AssetBundle;

class UploaderAsset extends AssetBundle
{
    public $sourcePath = '@static/vendor/plupload';
    public $css = [
    ];
    public $js = [
        "moxie.js",
        "plupload.dev.js",
    ];
}