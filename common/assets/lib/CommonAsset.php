<?php
/**
 * https://yii2-cookbook.readthedocs.org/structure-asset-processing-with-grunt/
 */
namespace common\assets\lib;

use yii\web\AssetBundle;

class CommonAsset extends AssetBundle
{
    public $sourcePath = '@static';
    public $css = [
    ];
    public $js = [
        'lib/strbuf.js',
        'lib/control-manager.js',
        'lib/checkall.js',
        'lib/rating.js',
    ];
    public $depends = [
    ];

    public function registerAssetFiles($view) {
        parent::registerAssetFiles($view);

        $view->registerJs('ControlManager.init()');
    }
}
