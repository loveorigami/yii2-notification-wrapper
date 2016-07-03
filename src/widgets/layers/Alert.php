<?php

namespace lo\modules\noty\widgets\layers;

use yii\bootstrap\Alert as BootstrapAlert;
use yii\helpers\Json;
use lo\modules\noty\widgets\Wrapper;

/**
 * Class Noty
 * @package lo\modules\noty\widgets\layers
 *
 * This widget should be used in your main layout file as follows:
 * ---------------------------------------
 *  use lo\modules\noty\widgets\Wrapper;
 *
 *  echo Wrapper::widget([
 *      'layerClass' => 'lo\modules\noty\widgets\layers\Alert',
 *  ]);
 * ---------------------------------------
 */
class Alert extends Layer implements LayerInterface
{
    /**
     * @var array the alert types configuration for the flash messages.
     * This array is setup as $key => $value, where:
     * - $key is the name of the session flash variable
     * - $value is the array:
     *       - class of alert type (i.e. danger, success, info, warning)
     *       - icon for alert AdminLTE
     */
    public $alertTypes = [
        self::TYPE_ERROR => [
            'class' => 'alert-danger',
            'icon' => '<i class="icon fa fa-ban"></i>',
        ],
        self::TYPE_SUCCESS => [
            'class' => 'alert-success',
            'icon' => '<i class="icon fa fa-check"></i>',
        ],
        self::TYPE_INFO => [
            'class' => 'alert-info',
            'icon' => '<i class="icon fa fa-info"></i>',
        ],
        self::TYPE_WARNING => [
            'class' => 'alert-warning',
            'icon' => '<i class="icon fa fa-warning"></i>',
        ],
    ];

    public function run()
    {
        $view = $this->getView();
        $asset = AlertAsset::register($view);
    }

    /**
     * @inheritdoc
     */
    public function getNotification($type, $message, $options)
    {

        $options['class'] = $this->alertTypes[$type]['class'];

        $msg = BootstrapAlert::widget([
            'body' => $this->alertTypes[$type]['icon'] . ' <strong>' .$this->getTitle($type). '</strong> '. $message,
            'options' => $options,
        ]);

        $msg = Json::encode($msg);
        $msg = trim($msg, '"');

        $id = Wrapper::WRAP_ID;

        return "$('#$id').append('$msg');";

    }
}
