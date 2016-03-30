<?php

namespace common\assets\lib;

use yii\web\AssetBundle;

class CarouselAsset extends AssetBundle
{
    public $sourcePath = '@static';
    public $css = [
    ];
    public $js = [
        'lib/jquery.carousel.js',
    ];
    public $depends = [
//        'common\assets\lib\CommonAsset',
    ];
}
