<?php

namespace lo\modules\noty\controllers;

use Yii;
use yii\helpers\Json;
use yii\web\Controller;
use lo\modules\noty\widgets\Wrapper;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        $layerClass = Yii::$app->request->post('layerClass');
        $options = Yii::$app->request->post('options');

        $layerClass = trim($layerClass, '"');

        $wrapper = new Wrapper([
            'layerClass' => $layerClass,
            'options' => Json::decode($options)
        ]);

        echo $wrapper->ajaxCallback();
    }
}
