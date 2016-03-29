<?php
/**
 * Created by brook
 * Date: 3/26/16 8:13 PM
 */
/* @var $this \yii\web\View */

use common\widgets\Prism;

$this->title = 'Javascript';

?>
<style>
    pre { max-height: 30em; }
</style>

<h1 class="page-header">strbuf</h1>
<?=Prism::widget(['src' => 'lib/strbuf.js'])?>

<h2 class="page-header">ControlManager</h2>
<?=Prism::widget(['src' => 'lib/control-manager.js'])?>
