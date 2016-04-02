<?php
/**
 * Created by brook
 * Date: 4/1/16 8:41 PM
 */
/* @var $this \yii\web\View */
use yii\helpers\Html;

$this->title = 'Vendor Plugins';

common\assets\vendor\ColorPickerAsset::register($this);
common\assets\vendor\Select2Asset::register($this);
common\assets\vendor\QrCodeAsset::register($this);

$colors = ["#55BD47", "#10AD61", "#35A4DE", "#3D78DA", "#9058CB", "#DE9C33", "#EBAC16", "#F9861F", "#E75735", "#D54036"];
$colors = array_combine($colors, $colors);
?>
<style>
.qr-wrap canvas { width: 300px; height: 300px; } /* large image for download, show more small */
.qr-wrap > div {  zoom: .75; } /* Zoom for IE 8 */
</style>
<?php $form = yii\widgets\ActiveForm::begin(['options' => [ 'class' => 'form-horizontal']]) ?>
<div class="form-group">
    <label class="control-label col-sm-3">Color</label>
    <div class="col-sm-5">
        <?=Html::dropDownList('color', null, $colors)?>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-sm-3">Category</label>
    <div class="col-sm-3">
        <?=Html::dropDownList('category', null, ['' => 'Select'] + $colors, ['class' => 'form-control'])?>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-sm-3">Category</label>
    <div class="col-sm-8">
        <div class="qr-wrap" data-href="http://google.com"></div>
    </div>
</div>
<?php yii\widgets\ActiveForm::end()?>
<script>
$(function() {
    $('[name=color]').simplecolorpicker();
    $('[name=category]').select2();
    var qrWrap = $('.qr-wrap');
    qrWrap.qrcode({text: qrWrap.data('href'), size: 400 });
});
</script>
