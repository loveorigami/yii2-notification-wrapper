<?php
/**
 * Created by PhpStorm.
 * User: loveorigami
 * Date: 20/3/16
 */

namespace lo\modules\noty\controllers;

use yii\web\Controller;
use yii\helpers\Json;
use lo\modules\noty\widgets\Wrapper;

class DefaultController extends Controller
{

    public function actionIndex()
    {
        $layerClass = \Yii::$app->request->post('layerClass');
        $options = \Yii::$app->request->post('options');

        $layerClass = str_replace('"', '', $layerClass);

        $wrapper = new Wrapper([
            'layerClass' => $layerClass,
            'options' => Json::decode($options)
        ]);

        echo $wrapper->ajaxCallback();
    }

} 