<?php

namespace common\assets\lib;

use yii\web\AssetBundle;

class ImageUploaderAsset extends AssetBundle
{
    public $sourcePath = '@static';
    public $css = [
    ];
    public $js = [
        'lib/imageuploader.js'
    ];
    public $depends = [
        'common\assets\vendor\UploaderAsset',
    ];
}
