<?php
/**
 * Created by brook
 * Date: 4/3/16 11:45 PM
 */
/* @var $this \yii\web\View */

$this->title = 'letter nav';

common\assets\lib\LetterNavAsset::register($this);
?>

<div class="letter-nav">
    <div class="nav-main" style="top: 51px; bottom: 30px;">
        <dl>
            <dt id="anchor_A">A</dt>
            <dd>alpha</dd>
            <dd>alight</dd>
            <dd>alpha</dd>
            <dd>alight</dd><dd>alpha</dd>
            <dd>alight</dd><dd>alpha</dd>
            <dd>alight</dd>
        </dl>
        <dl>
            <dt id="anchor_B">B</dt>
            <dd>brook</dd>
            <dd>bright</dd><dd>brook</dd>
            <dd>bright</dd><dd>brook</dd>
            <dd>bright</dd><dd>brook</dd>
            <dd>bright</dd><dd>brook</dd>
            <dd>bright</dd>
        </dl>
        <dl>
            <dt id="anchor_C">C</dt>
            <dd>come</dd>
            <dd>communication</dd><dd>come</dd>
            <dd>communication</dd><dd>come</dd>
            <dd>communication</dd><dd>come</dd>
            <dd>communication</dd><dd>come</dd>
            <dd>communication</dd>
        </dl>
        <dl>
            <dt id="anchor_D">D</dt>
            <dd>diligence</dd>
            <dd>deride</dd><dd>diligence</dd>
            <dd>deride</dd><dd>diligence</dd>
            <dd>deride</dd><dd>diligence</dd>
            <dd>deride</dd><dd>diligence</dd>
            <dd>deride</dd>
        </dl>
        <dl>
            <dt id="anchor_E">E</dt>
            <dd>evolve</dd>
            <dd>endearing</dd><dd>evolve</dd>
            <dd>endearing</dd><dd>evolve</dd>
            <dd>endearing</dd><dd>evolve</dd>
            <dd>endearing</dd>
        </dl>
        <dl>
            <dt id="anchor_G">G</dt>
            <dd>group</dd>
            <dd>game</dd><dd>group</dd>
            <dd>game</dd><dd>group</dd>
            <dd>game</dd><dd>group</dd>
            <dd>game</dd>
        </dl>
        <dl>
            <dt id="anchor_H">H</dt>
            <dd>humble</dd>
            <dd>humidity</dd><dd>humble</dd>
            <dd>humidity</dd><dd>humble</dd>
            <dd>humidity</dd><dd>humble</dd>
            <dd>humidity</dd>
        </dl>
        <dl>
            <dt id="anchor_I">I</dt>
            <dd>insist</dd>
            <dd>instrument</dd><dd>insist</dd>
            <dd>instrument</dd><dd>insist</dd>
            <dd>instrument</dd><dd>insist</dd>
            <dd>instrument</dd>
        </dl>
        <dl>
            <dt id="anchor_K">K</dt>
            <dd>kindle</dd>
            <dd>kernel</dd>
            <dd>kindle</dd>
            <dd>kernel</dd><dd>kindle</dd>
            <dd>kernel</dd><dd>kindle</dd>
            <dd>kernel</dd><dd>kindle</dd>
            <dd>kernel</dd>
        </dl>
        <dl>
            <dt id="anchor_L">L</dt>
            <dd>love</dd>
            <dd>lottery</dd>
            <dd>love</dd>
            <dd>lottery</dd><dd>love</dd>
            <dd>lottery</dd><dd>love</dd>
            <dd>lottery</dd><dd>love</dd>
            <dd>lottery</dd><dd>love</dd>
            <dd>lottery</dd>
        </dl>
        <dl>
            <dt id="anchor_M">M</dt>
            <dd>miracle</dd>
            <dd>majority</dd>
            <dd>miracle</dd>
            <dd>majority</dd><dd>miracle</dd>
            <dd>majority</dd><dd>miracle</dd>
            <dd>majority</dd><dd>miracle</dd>
            <dd>majority</dd>
        </dl>
        <dl>
            <dt id="anchor_Z">Z</dt>
            <dd>Zeal</dd>
            <dd>zinc</dd>
            <dd>Zeal</dd>
            <dd>zinc</dd><dd>Zeal</dd>
            <dd>zinc</dd><dd>Zeal</dd>
            <dd>zinc</dd><dd>Zeal</dd>
            <dd>zinc</dd><dd>Zeal</dd>
            <dd>zinc</dd><dd>Zeal</dd>
            <dd>zinc</dd><dd>Zeal</dd>
            <dd>zinc</dd>
        </dl>
    </div>
</div>
<script>
$(function() {
   $('.letter-nav').letterNav();
});
</script>

