<?php

namespace lo\modules\noty\layers;

use yii\bootstrap\Alert as BootstrapAlert;
use yii\helpers\Json;
use lo\modules\noty\assets\AlertAsset;

/**
 * Class Noty
 * @package lo\modules\noty\layers
 *
 * This widget should be used in your main layout file as follows:
 * ---------------------------------------
 *  use lo\modules\noty\Wrapper;
 *
 *  echo Wrapper::widget([
 *      'layerClass' => 'lo\modules\noty\layers\Alert',
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

    /**
     * @inheritdoc
     */
    public function run()
    {
        $view = $this->getView();
        AlertAsset::register($view);
        parent::run();
    }

    /**
     * @param $options
     * @return string
     */
    public function getNotification($options)
    {

        $options['class'] = $this->alertTypes[$this->type]['class'];

        $msg = BootstrapAlert::widget([
            'body' => $this->alertTypes[$this->type]['icon']. ' '. $this->getMessageWithTitle(),
            'options' => $options,
        ]);

        $msg = Json::encode($msg);
        $msg = trim($msg, '"');

        $id = $this->getLayerId();

        return "$('#$id').append('$msg');";

    }
}
