<?php
/* @var $this \yii\web\View */
$this->title = 'Demo1';

common\assets\lib\InterSelectAsset::register($this);
common\assets\lib\DistrictAsset::register($this);
common\assets\lib\ImageUploaderAsset::register($this);

?>
<style>
    .rating { font-size: 2em; }
</style>
<form class="form-horizontal">
    <div class="form-group">
        <label class="control-label col-sm-3">Rate</label>
        <div class="col-sm-5">
            <div data-toggle="rating" data-value="3" ></div><br/>
            <div data-toggle="rating" data-value="3.5" ></div><br/>
            <div data-name="post_name" data-toggle="rating" data-value="3"></div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-5 col-sm-offset-3">
            <label class="checkable"><input type="checkbox"/><span></span> Remember me</label>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-3">Your choices</label>
        <div class="col-sm-7">
            <label class="checkable"><input type="checkbox"/><span></span> Google<span class="aa"></span></label>
            <label class="checkable"><input type="checkbox"/><span></span> Apple<span class="aa"></span></label>
            <label class="checkable"><input type="checkbox"/><span></span> Twitter</label>
            <label class="checkable"><input type="checkbox" disabled/><span></span> Disabled</label>
            <label class="checkable"><input type="checkbox" disabled/><span></span> Disabled && Checked</label>
        </div>
    </div>
    <script>
    $(':checkbox').change(function() {
        $(this).siblings('.aa').text(this.checked? ' checked': ' unchecked');
    });
    </script>
    <div class="form-group">
        <label class="control-label col-sm-3">Gender</label>
        <div class="col-sm-5">
            <label class="checkable"><input type="radio" name="aa"/><span></span> Male</label>
            <label class="checkable"><input type="radio" name="aa"/><span></span> Female</label>
            <label class="checkable"><input type="radio" name="aa"/><span></span> Unknown</label>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-3">地区</label>
        <div class="col-sm-5 form-inline" data-toggle="district" ></div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-3">分类</label>
        <div class="col-sm-5 form-inline" data-toggle="interSelect" data-data='<?=json_encode($cats)?>' ></div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-3">上传头像</label>
        <div class="col-sm-8">
            <ul class="image-uploader" data-limit="1"></ul>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-3">产品图片</label>
        <div class="col-sm-8">
            <ul class="image-uploader" data-limit="5"></ul>
        </div>
    </div>
</form>


<script>
    $(function() {
        $('.image-uploader').imageUploader();
    });
</script>
