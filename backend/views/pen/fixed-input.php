<?php
/**
 * Created by brook
 * Date: 4/1/16 4:07 PM
 */
?>
使用 scrollIntoView 修复手机端 fixed input 无法正确定位问题
<style>
#fixed_bar { background:#f0f0f0; position: fixed;left: 0; right: 0; bottom: 0; padding: 10px; }
#fixed_bar input { border: solid 1px #ccc; width:100%; padding: 10px; }
</style>
<div id="fixed_bar">
    <input type="text" id="txt_msg"/>
</div>
<script>
$(function() {
    $(document.documentElement).data('require-touch', true);
    $('#txt_msg').focus(function() {
        var input = this;
        for(var i = 0; i <= 5; i ++) {
            setTimeout(function () {
                input.scrollIntoView();
            }, 200 * i);
        }
    });
})
</script>
