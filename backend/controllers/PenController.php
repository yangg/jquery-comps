<?php
/**
 * Created by brook
 * Date: 4/1/16 10:31 PM
 */

namespace backend\controllers;


class PenController extends Controller {

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionMissing($action) {
        $methodName = 'action' . str_replace(' ', '', ucwords(implode(' ', explode('-', $action))));
        if(method_exists($this, $methodName)) {
            return call_user_func([$this, $methodName]);
        }
        return $this->render($action);
    }
}
