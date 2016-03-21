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
use lo\modules\noty\widgets\Noty;


class DefaultController extends Controller
{

    /** @var string $theme */
    public $theme;

    /** @var array  $options */
    public $options;

    /** @var string $types */
    public $types = ['info', 'error', 'success', 'warning'];

    /** @var string $typeDefault */
    public $typeDefault = 'info';

    public function actionIndex()
    {
        $this->theme = \Yii::$app->request->post('theme');
        $this->options = \Yii::$app->request->post('options');

        echo "<script>".self::flashes()."</script>";
    }

    protected function flashes()
    {
        $session = \Yii::$app->session;
        $flashes = $session->getAllFlashes();
        $f='';

        foreach ($flashes as $type => $data) {

            $data = (array)$data;

            switch($this->theme){
                case Noty::THEME_TOASTR:
                    foreach ($data as $i => $message) {
                        if (in_array($type, $this->types)){
                            $f .= "toastr.{$type}(\"{$message}\", \"{$title}\", {$this->options});";
                        } else {
                            $f .= "toastr.{$this->typeDefault}(\"{$message}\", \"{$title}\", {$this->options});";
                        }
                    }
                    break;
                case Noty::THEME_NOTY:
                    $f .= "var n = Noty('notyjs')";
                    foreach ($data as $i => $message) {
                        if (in_array($type, $this->types)){
                            $f .= "
                                $.noty.setText(n.options.id, '$message');
                                $.noty.setType(n.options.id, '$type');
                            ";
                        } else {
                            $f .= "
                                $.noty.setText(n.options.id, '$message');
                                $.noty.setType(n.options.id, '{$this->typeDefault}');
                            ";
                        }
                    }
                    break;
            }

            $session->removeFlash($type);
        }

        return $f;
    }
} 