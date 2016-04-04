<?php
/**
 * Created by brook
 * Date: 4/3/16 11:45 PM
 */
/* @var $this \yii\web\View */

$this->title = 'letter nav';

common\assets\lib\LetterNavAsset::register($this);
?>
<style>
.navbar { display: none; }
.animate-pop {
    position: fixed; top: 0; bottom: 0; left: 0; right:0;
    background-color: rgba(0, 0, 0, 0); -webkit-transition: all .5s ease; transition: all .5s ease;
}
.animate-pop.show { background-color: rgba(0, 0, 0, 0.5); }
.animate-pop .pop-main { position: absolute; -webkit-transition: all .5s ease; transition: all .5s ease; }

.select-pop { display: none; }
.select-pop .pop-main { width: 80%; height: 100%; right: -100%; background: #fff; }
.select-pop.show .pop-main { right: 0; }

.pop-main { font-size: 16px; overflow: auto; -webkit-overflow-scrolling: touch; }
.pop-main.scrolling { -webkit-overflow-scrolling: auto; }
.pop-main dt { background-color: #e9e9e9; line-height: 1.5; padding: 0 15px; font-weight: bold; position: -webkit-sticky; position: sticky; top: 0; }
.pop-main dd { padding: 10px 15px; border-top: solid 1px #ddd; }
.pop-main dd.tapped { background-color: #e9e9e9;}

.anchor-list{ font-size: 14px; line-height: 1.3; width: 1.5em; text-align: center; position: fixed; right: 0; top: 50%; margin-top: -210px; }
</style>
<div style="margin-top: 50px; text-align: center;">
    <button style="font-size: 18px;">Show</button>
    <a href="javascript:">Hello Link</a>
</div>
<div>
    <div></div>
</div>
<div class="select-pop animate-pop">
    <div class="pop-main">
        <dl>
            <dt id="anchor_A">A</dt>
            <dd>alpha</dd>
            <dd>alight</dd>
        </dl>
        <dl>
            <dt id="anchor_B">B</dt>
            <dd>brook</dd>
            <dd>bright</dd>
        </dl>
        <dl>
            <dt id="anchor_C">C</dt>
            <dd>come</dd>
            <dd>communication</dd>
        </dl>
        <dl>
            <dt id="anchor_D">D</dt>
            <dd>diligence</dd>
            <dd>deride</dd>
        </dl>
        <dl>
            <dt id="anchor_E">E</dt>
            <dd>evolve</dd>
            <dd>endearing</dd>
        </dl>
        <dl>
            <dt id="anchor_G">G</dt>
            <dd>group</dd>
            <dd>game</dd>
        </dl>
        <dl>
            <dt id="anchor_H">H</dt>
            <dd>humble</dd>
            <dd>humidity</dd>
        </dl>
        <dl>
            <dt id="anchor_I">I</dt>
            <dd>insist</dd>
            <dd>instrument</dd>
        </dl>
        <dl>
            <dt id="anchor_K">K</dt>
            <dd>kindle</dd>
            <dd>kernel</dd>
        </dl>
        <dl>
            <dt id="anchor_L">L</dt>
            <dd>love</dd>
            <dd>lottery</dd>
        </dl>
        <dl>
            <dt id="anchor_M">M</dt>
            <dd>miracle</dd>
            <dd>majority</dd>
        </dl>
        <dl>
            <dt id="anchor_Z">Z</dt>
            <dd>Zeal</dd>
            <dd>zinc</dd>
        </dl>
    </div>
    <div class="anchor-list"></div>
</div>
<script>
$(function() {
    var selectPop = $('.select-pop');
    $('button').click( function() {
        selectPop.show();
        selectPop.find('.pop-main').letterNav();
        requestAnimationFrame(function() {
            selectPop.addClass('show');
        });
    });
    selectPop.find('.pop-main').on('transitionend webkitTransitionEnd', function() {
        if(!selectPop.hasClass('show')) {
            selectPop.hide();
        }
    }).on('swipeRight', function() {
        selectPop.removeClass('show');
//    }).on('touchstart MSPointerDown pointerdown', 'dd', function() {

//    }).on('touchend MSPointerUp pointerup', 'dd', function() {

    }).on('tap', 'dd', function(e) {
        var that = $(this).addClass('tapped');
        setTimeout(function() {
            that.removeClass('tapped');
        }, 100);

        console.log('do something on tap!');
    });
    selectPop.click( function(e) {
        if(e.target == selectPop[0]) { // 点击左侧空白区域
            selectPop.removeClass('show');
        }
    });
});
</script>

