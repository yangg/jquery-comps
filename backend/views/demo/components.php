<?php
/* @var $this \yii\web\View */

use yii\helpers\Html;
use common\widgets\Prism;

$this->title = 'Components';

common\assets\lib\InterSelectAsset::register($this);
common\assets\lib\DistrictAsset::register($this);
?>

<style>
    .rating { font-size: 2em; }
    p > code {
        padding: 2px 4px;
        font-size: 90%;
        color: #c7254e;
        background-color: #f9f2f4;
        border-radius: 4px;
    }
</style>

<h1 class="page-header">Rating</h1>
<p class="lead">Simple rating control
</p>
<div>
    <div data-toggle="rating" data-value="2"></div><br/>
    <div data-toggle="rating" data-value="3.5"></div>
</div>
<p style="margin-top: 10px;">Add <code>data-name="..."</code> to enable edit & submit selected value to server</p>
<div>
    <div data-name="rating_value" data-toggle="rating" data-value="3"></div>
    <p class="text-muted">Click to select a value</p>
</div>
<h2>Usage</h2>
<?php Prism::begin()?>
<div data-toggle="rating" data-value="2"></div><br/>
<div data-toggle="rating" data-value="3.5"></div>
<div data-name="rating_value" data-toggle="rating" data-value="3"></div>
<?php Prism::end()?>
<?php Prism::begin(['lang' => 'php'])?>
<div data-toggle="rating" data-value="2"></div><br/>
<div data-toggle="rating" data-value="3.5"></div>
<div data-name="rating_value" data-toggle="rating" data-value="3"></div>
<?php Prism::end()?>

<h1 class="page-header">Checkable</h1>
<p class="lead">Customized checkbox & radio, pure CSS</p>
<div>
    <label class="checkable"><input checked type="checkbox"/><span></span> Google</label>
    <label class="checkable"><input type="checkbox"/><span></span> Apple</label>
    <label class="checkable"><input type="checkbox"/><span></span> Twitter</label>
</div>
<div>
    <label class="checkable"><input type="radio" name="gender"/><span></span> Male</label>
    <label class="checkable"><input type="radio" name="gender"/><span></span> Female</label>
    <label class="checkable"><input type="radio" name="gender"/><span></span> Unknown</label>
</div>
<h2>Usage</h2>
<p>
    Simply add <code>class="checkable"</code> to label & a <code>span</code> next to <code>:checkbox</code> or <code>:radio</code>
</p>
<?php Prism::begin()?>
<div>
    <label class="checkable"><input checked type="checkbox"/><span></span> Google</label>
    <label class="checkable"><input type="checkbox"/><span></span> Apple</label>
    <label class="checkable"><input type="checkbox"/><span></span> Twitter</label>
</div>
<div>
    <label class="checkable"><input type="radio" name="gender"/><span></span> Male</label>
    <label class="checkable"><input type="radio" name="gender"/><span></span> Female</label>
    <label class="checkable"><input type="radio" name="gender"/><span></span> Unknown</label>
</div>
<?php Prism::end()?>

<h1 class="page-header">InterSelect</h1>
<p class="lead">...</p>
<div data-toggle="interSelect" data-data='<?=json_encode($cats)?>' class="form-inline" ></div>
<h2>District</h2>
<div data-toggle="district" style="margin-top: 10px;" class="form-inline" ></div>
<h2>Usage</h2>
<?php Prism::begin()?>
<div data-toggle="interSelect" data-data='...'  class="form-inline"></div>
<div data-toggle="district"  style="margin-top: 10px;" class="form-inline"></div>
<?php Prism::end()?>


<h1 class="page-header">TabsSelect</h1>
<div class="row">
    <div class="col-sm-5">
        <div data-toggle="tabsSelect" data-name="name_submitted_2_server[]" data-value='[1, 101]' class="form-control" >
            <?=common\widgets\Brand::widget()?>
        </div>
    </div>
</div>
<h2>Usage</h2>
<?php Prism::begin()?>
<div data-toggle="tabsSelect" data-name="name_submitted_2_server[]" data-value='[1, 101]' class="form-control" >
    &lt;?=common\widgets\Brand::widget()?>
</div>
<?php Prism::end()?>

