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
        $theme = \Yii::$app->request->post('theme');
        $options = \Yii::$app->request->post('options');

        $wrapper = new Wrapper([
            'theme' => $theme,
            'options' => Json::decode($options)
        ]);

        echo $wrapper->ajaxCallback();
    }

} 