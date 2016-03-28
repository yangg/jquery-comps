<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace common\assets\vendor;

use yii\web\AssetBundle;

class TreeAsset extends AssetBundle
{
    public $sourcePath = '@static/vendor/jstree';
    public $css = [
        'themes/default/style.css',
    ];
    public $js = [
        'jstree.js',
    ];
}