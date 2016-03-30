<?php
/**
 * Created by brook
 * Date: 3/22/16 1:30 PM
 */

namespace backend\controllers;


use backend\models\UploadForm;
use yii\web\UploadedFile;

class DemoController extends Controller {

    public function beforeAction($action) {
        if ($action->id == 'upload') {
            $this->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
    }

    public function actionIndex() {

        $cats = [
            [ 'id' => 1, 'name' => 'Haha', 'parent_id' => 0],
            [ 'id' => 2, 'name' => 'Yaya', 'parent_id' => 0],
            [ 'id' => 11,'name' => 'Child', 'parent_id' => 1 ],
        ];

        return $this->render('index', compact('cats'));
    }

    public function actionPost() {
        dump($_POST);
        die;
    }

    public function actionCatTree() {
        return <<<JSON
[
    { "text" : "Root node", "id": 1, "children" : [
        { "text" : "Child node 1", "id": 2 },
        { "text" : "Child node 2", "id": 3 , "children" : [
            { "text" : "Child node 3", "id": 4 },
            { "text" : "Child node 4", "id": 5 }
        ]}
    ]}
]
JSON;
    }

    public function actionUpload() {
        $model = new UploadForm();
        $model->imageFile = UploadedFile::getInstanceByName('file');
        if ($data = $model->upload()) {
            $this->json = array('code' => 0, 'data' => $data);
        } else {
            $this->json['msg'] = $model->getFirstError('imageFile');
        }
        return $this->json();
    }

    public function actionComponents() {

        $cats = [
            [ 'id' => 1, 'name' => 'Haha', 'parent_id' => 0],
            [ 'id' => 2, 'name' => 'Yaya', 'parent_id' => 0],
            [ 'id' => 11,'name' => 'Child', 'parent_id' => 1 ],
        ];
        return $this->render('components', compact('cats'));
    }

    public function actionJavascript() {
        return $this->render('javascript');
    }

    public function actionOther() {
        $adverts = [
            [ 'image' => 'http://ww2.sinaimg.cn/large/6eba2496gw1erep0e1leyj21hc0xcwlh.jpg', 'link' => '', 'title' => ''],
            [ 'image' => 'http://ww3.sinaimg.cn/large/6eba2496gw1erfjlqhxh6j20e80lc76b.jpg', 'link' => '', 'title' => ''],
            [ 'image' => 'http://ww3.sinaimg.cn/large/6eba2496gw1erfjm47r6rj208c0b4t8z.jpg', 'link' => '', 'title' => ''],
        ];
        return $this->render('other', compact('adverts'));
    }

//    public function actionMissing($action) {
//        $methodName = 'action' . str_replace(' ', '', ucwords(implode(' ', explode('-', $action))));
//        if(method_exists($this, $methodName)) {
//            return call_user_func([$this, $methodName]);
//        }
//        return $this->render($action);
//    }
}
