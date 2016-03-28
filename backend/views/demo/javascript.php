<?php
/**
 * Created by brook
 * Date: 3/26/16 8:13 PM
 */
/* @var $this \yii\web\View */

$this->title = 'Javascript';


$this->params['baseUrl'] = backend\assets\AppAsset::register($this)->baseUrl;
common\assets\vendor\PrismAsset::register($this);
?>
<style>
    pre { max-height: 30em; }
</style>

<h1 class="page-header">strbuf</h1>
<pre data-src="<?=$this->params['baseUrl']?>/lib/strbuf.js"></pre>

<h2 class="page-header">ControlManager</h2>
<pre data-src="<?=$this->params['baseUrl']?>/lib/control-manager.js"></pre>
