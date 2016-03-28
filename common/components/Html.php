<?php
/**
 * Created by brook
 * Date: 3/27/16 9:03 AM
 */

namespace yii\helpers;;


class Html extends BaseHtml{

    private static $_lang;
    public static function beginCode($lang = 'html') {
        self::$_lang = $lang;
        ob_start();
    }

    public static function endCode() {
        $codeHtml = ob_get_clean();
        echo sprintf('<pre><code class="language-%s">%s</code></pre>', self::$_lang, parent::encode($codeHtml));
    }

}
