<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace common\assets\lib;

use yii\web\AssetBundle;

class CountDownAsset extends AssetBundle
{
    public $sourcePath = '@static';
    public $css = [
    ];
    public $js = [
        'lib/countdown.js',
    ];
    public $depends = [
    ];
}