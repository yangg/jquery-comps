<?php

namespace common\assets\vendor;

use yii\web\AssetBundle;

class FullCalendarAsset extends AssetBundle
{
    public $sourcePath = '@static/vendor/fullcalendar';
    public $css = [
        'fullcalendar.css'
    ];
    public $js = [
        'fullcalendar.js',
    ];

    public $depends = [
        'common\assets\vendor\MomentAsset',
    ];
}
