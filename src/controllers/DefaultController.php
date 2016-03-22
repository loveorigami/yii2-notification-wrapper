<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/4/14
 * Time: 2:01 PM
 */

namespace lo\modules\noty\controllers;

use yii\web\Controller;
use lo\modules\noty\widgets\Wrapper;


class DefaultController extends Controller
{

    public function actionIndex()
    {
        $theme = \Yii::$app->request->post('theme');
        $options = \Yii::$app->request->post('options');

        $wrapper = new Wrapper();
        echo $wrapper->ajaxCallback($theme, $options);
    }

} 
