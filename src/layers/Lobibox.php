<?php

namespace lo\modules\noty\layers;

use yii\helpers\Json;
use lo\modules\noty\assets\LobiboxAsset;

/**
 * Class Lobibox
 * @package lo\modules\noty\layers
 *
 * This widget should be used in your main layout file as follows:
 * ---------------------------------------
 *  use lo\modules\noty\Wrapper;
 *
 *  echo Wrapper::widget([
 *      'layerClass' => 'lo\modules\noty\layers\Lobibox',
 *      // default options
 *      'options' => [
 *          'pauseDelayOnHover' => true,
 *          'continueDelayOnInactiveTab' => true,
 *          'delay' => 15000,  //In milliseconds,
 *          'position' => 'top right'
 *
 *          // and more for this library...
 *      ],
 *  ]);
 * ---------------------------------------
 */
class Lobibox extends Layer implements LayerInterface
{
    /**
     * @var array $defaultOptions
     */
    protected $defaultOptions = [
        'pauseDelayOnHover' => true,
        'continueDelayOnInactiveTab' => true,
        'delay' => 5000,  //In milliseconds,
        'position' => 'top right',
        'sound' => false
    ];

    /**
     * register asset
     */
    public function run()
    {
        $view = $this->getView();
        LobiboxAsset::register($view);
        parent::run();
    }

    /**
     * @param $options
     * @return string
     */
    public function getNotification($options)
    {
        $data = $options;

        $data['msg'] = $this->message;
        $data['title'] = $this->title;

        $msg = Json::encode($data);

        return "Lobibox.notify('$this->type', $msg);";
    }

}
