<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/4/14
 * Time: 2:01 PM
 */

namespace lo\modules\noty\controllers;

use yii\web\Controller;
use yii\web\NotFoundHttpException;


class DefaultController extends Controller
{
    public function actionIndex()
    {

        echo "<script>".self::flashes()."</script>";
        //$this->view->registerJs("toastr.info('test', 'info')");
        //echo \lavrentiev\widgets\toastr\NotificationFlash::widget();
    }

    protected function flashes()
    {
        $session = \Yii::$app->session;
        $flashes = $session->getAllFlashes();
        $f='';

        foreach ($flashes as $type => $data) {
            $data = (array)$data;
            foreach ($data as $i => $message) {
                $f.="toastr.$type('.$message.');";
            }
            $session->removeFlash($type);
        }

        return $f;
    }
} 