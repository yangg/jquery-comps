<?php
/**
 * Created by brook
 * Date: 3/23/16 8:39 PM
 */

use yii\helpers\Html;

$this->title = 'Other';

common\assets\lib\ImageUploaderAsset::register($this);
common\assets\lib\CatTreeAsset::register($this);
common\assets\lib\InputFilterAsset::register($this);
common\assets\lib\CountDownAsset::register($this);
common\assets\vendor\PrismAsset::register($this);
?>

<h1 class="page-header">ImageUploader</h1>
<p class="lead">Based on <a href="http://www.plupload.com/">Plupload</a></p>
<ul class="image-uploader" data-limit="1"></ul>
<ul class="image-uploader" data-limit="5"></ul>

<h1 class="page-header">CatTree</h1>
<div class="row">
    <div class="col-sm-5">
        <div class="form-control" data-toggle="catTree" data-name="product_category_id[]" data-value='[1, 3, 4]'></div>
    </div>
</div>

<h1 class="page-header">InputFilter</h1>
<div class="row">
    <div class="col-sm-5">
        <p><input data-toggle="masked" maxlength="14" name="code" class="form-control" placeholder="Input verify code"/></p>
        <p><input data-toggle="numberFilter" class="form-control" ></p>
        <p><input data-toggle="numberFilter" data-decimal="2" class="form-control"/></p>
    </div>
</div>
<h2>Usage</h2>
<?php Html::beginCode()?>
<p><input data-toggle="masked" maxlength="14" name="code" class="form-control"/></p>
<p><input data-toggle="numberFilter" class="form-control" ></p>
<p><input data-toggle="numberFilter" data-decimal="2" class="form-control"/></p>
<?php Html::endCode()?>

<h1 class="page-header">$.fn.countDown</h1>
Time remained: <span class="count-down" data-end="<?=strtotime('+5 mins')?>"?></span>

<script>
    $(function() {
        $('.image-uploader').imageUploader();

        $('.count-down').countDown({
            onEnd: function() {
                alert("You've opened this page for 5 minutes!");
            }
        });
    });
</script>
