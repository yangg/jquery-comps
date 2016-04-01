<?php
/**
 * Created by brook
 * Date: 3/23/16 2:41 PM
 */

namespace backend\controllers;


use yii\helpers\ArrayHelper;

class Controller extends \yii\web\Controller {

    public function init() {
        $asset = \common\assets\lib\BaseAsset::register($this->view);
        \Yii::setAlias('@asset', $asset->baseUrl);
    }

    public $json = ['code' => 1];
    public function json($json = []) {
        $output = ArrayHelper::merge($this->json, $json);
        \Yii::$app->response->format = 'json';
        if(YII_DEBUG) {
            $output['_POST'] = \Yii::$app->request->post();
            $output['_GET'] = \Yii::$app->request->get();
        }
        return $output;
    }
}
