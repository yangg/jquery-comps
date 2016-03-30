<?php

namespace common\assets\vendor;

use yii\web\AssetBundle;

class PrismAsset extends AssetBundle
{
    public $sourcePath = '@static/vendor/prism';
    public $css = [
        'prism.css'
    ];
    public $js = [
        'prism.js',
    ];

    public function registerAssetFiles($view) {
        parent::registerAssetFiles($view);

        $view->registerJs('Prism.plugins.autoloader.languages_path = "//7xsffj.com1.z0.glb.clouddn.com/prism-components/";', \yii\web\View::POS_END);
    }
}
