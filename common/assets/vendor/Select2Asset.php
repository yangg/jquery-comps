<?php

namespace common\assets\vendor;

use yii\web\AssetBundle;

class Select2Asset extends AssetBundle
{
    public $sourcePath = '@static/vendor/select2';
    public $css = [
        "css/select2.css",
        "css/select2-bootstrap.css",
    ];
    public $js = [
        "js/select2.js",
        "js/i18n/zh-CN.js",
    ];
    public $depends = [
    ];

    public function registerAssetFiles($view) {
        parent::registerAssetFiles($view);

        $view->registerJs('$.fn.select2.defaults.set("theme", "bootstrap");', \yii\web\View::POS_END);
    }
}