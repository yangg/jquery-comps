<?php
/**
 * Created by brook
 * Date: 3/23/16 8:39 PM
 */
/* @var $this \yii\web\View */

use yii\helpers\Html;
use common\widgets\Prism;

$this->title = 'Other';

common\assets\lib\ImageUploaderAsset::register($this);
common\assets\lib\CatTreeAsset::register($this);
common\assets\lib\InputFilterAsset::register($this);
common\assets\lib\CountDownAsset::register($this);

$this->registerJsFile('@asset/lib/jquery.carousel.js');
?>
<style>
.carousel { width: 480px; max-width: 100%; }
.carousel .item { height: 300px; }
</style>

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
        <p><input data-toggle="masked" data-rule="phone" maxlength="13" name="code" class="form-control" placeholder="cellphone number"/></p>
        <p><input data-toggle="masked" maxlength="19" name="code" class="form-control" placeholder="Bank Card ID"/></p>
        <p><input data-toggle="numberFilter" class="form-control" /></p>
        <p><input data-toggle="numberFilter" data-decimal="2" class="form-control"/></p>
    </div>
</div>
<h2>Usage</h2>
<?php Prism::begin()?>
<p><input data-toggle="masked" maxlength="14" name="code" class="form-control"/></p>
<p><input data-toggle="numberFilter" class="form-control" ></p>
<p><input data-toggle="numberFilter" data-decimal="2" class="form-control"/></p>
<?php Prism::end()?>

<h1 class="page-header">$.fn.countDown</h1>
Time remained: <span class="count-down" data-end="<?=strtotime('+5 mins')?>"?></span>

<h1 class="page-header">$.fn.carousel</h1>
<div data-toggle="carousel" class="carousel" style="">
    <div class="carousel-scroller">
        <div class="carousel-inner">
            <?php foreach ($adverts as $adv): ?>
                <a href="<?= $adv['link'] ? : 'javascript:'  ?>" class="item">
                    <img src="<?= $adv['image'] ?>" title="<?= $adv['title'] ?>"/>
                </a>
            <?php endforeach ?>
        </div>
    </div>
    <a href="javascript:" class="carousel-next carousel-prev" data-backward="true"><i class="icon i-angle-left"></i></a>
    <a href="javascript:" class="carousel-next"><i class="icon i-angle-right"></i></a>
    <div class="carousel-pager"></div>
</div>

<script>
    $(function() {
        $('.image-uploader').imageUploader();

        $('.count-down').countDown({
            onEnd: function() {
                console.log("You've opened this page for 5 minutes!");
            }
        });
        $.fn.carousel.noConflict && $.fn.carousel.noConflict(); // if bootstrap carousel load first
        $('.carousel').carousel();
    });
</script>
