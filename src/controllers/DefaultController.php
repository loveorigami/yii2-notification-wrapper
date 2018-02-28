<?php

namespace lo\modules\noty\controllers;

use Yii;
use yii\helpers\Json;
use yii\web\Controller;
use lo\modules\noty\Wrapper;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        $layerClass = Yii::$app->request->post('layerClass');
        $layerClass = trim($layerClass, '"');

        $config = Yii::$app->request->post('config');
        $config = Json::decode($config);
        $config['layerClass'] = $layerClass;

        $wrapper = new Wrapper($config);

        return $wrapper->ajaxCallback();
    }
}
