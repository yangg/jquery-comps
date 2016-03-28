<?php
/**
 * Created by brook
 * Date: 3/23/16 2:41 PM
 */

namespace backend\controllers;


class Controller extends \yii\web\Controller {

    public $json = array('code' => 1);
    public function json() {
        return json_encode($this->json);
    }
}
