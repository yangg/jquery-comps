<?php
/**
 * Created by brook
 * Date: 3/29/16 9:49 AM
 */

namespace common\widgets;


use yii\base\Widget;
use yii\helpers\Html;

class Prism extends Widget{

    public $lang;
    public $baseUrl;
    public $src;

    public function init() {
        parent::init();

        \common\assets\vendor\PrismAsset::register($this->view);

        if($this->src) {
            $this->baseUrl = \common\assets\lib\CommonAsset::register($this->view)->baseUrl;
        } else {
            ob_start();
        }
    }

    public function run()
    {
        if($this->src) {
            return sprintf('<pre data-src="%s/%s"></pre>', $this->baseUrl, $this->src);
        }
        $content = ob_get_clean();
        if(!$this->lang) {
            // try to get lang from script type
            if(preg_match('#^\s*<script\s+type="text/(\w+)"#', $content, $matches) === 1) {
                $this->lang = $matches[1];
                $content = preg_replace('#^\s*<script[^>]*>\s*|\s*</script>\s*$#', '', $content);
            }
        }
        $this->lang = $this->lang ?: 'html'; // default to html
        $content = Html::encode($content, false);
        return sprintf('<pre><code class="language-%s">%s</code></pre>', $this->lang, $content);;
    }

}
