<?php
/**
 * Created by brook
 * Date: 4/1/16 4:07 PM
 */
?>
使用 scrollIntoView 修复手机端 fixed input 无法正确定位问题
<style>
#fixed_bar { background:#f0f0f0; position: fixed;left: 0; right: 0; bottom: 0; padding: 10px; }
#fixed_bar.focused { position: absolute; }
</style>
<?php for($i = 0; $i < 100; $i++) {?>
<div>line <?=$i?></div>
<?php } ?>
<div id="fixed_bar">
    Fill the form
    <p><input type="text" id="txt_msg" class="form-control"/></p>
    <input type="tel" class="form-control"/>
</div>
<script>
$(function() {
    $(document.documentElement).data('require-touch', true);
    $('#txt_msg').focus(function() {
        var input = this;
        // 输入法启动慢，要多次, 或者 setInterval 避免切换输入时高度改变
        $(this).data('fixedTimer', setInterval(function () {
            input.scrollIntoView();
        }, 300));

        for(var i = 1; i < 11; i++) {
            setTimeout(function() {
//                input.scrollIntoView();
            }, i * 300);
        }
    }).blur(function() {
        clearInterval($(this).data('fixedTimer'));
    });
});
</script>
