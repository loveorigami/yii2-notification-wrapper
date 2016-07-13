<?php

namespace lo\modules\noty\layers;

use yii\helpers\Json;
use lo\modules\noty\assets\ToastrAsset;

/**
 * Class Toastr
 * @package lo\modules\noty\layers
 *
 * This widget should be used in your main layout file as follows:
 * ---------------------------------------
 *  use lo\modules\noty\Wrapper;
 *
 *  echo Wrapper::widget([
 *      'layerClass' => 'lo\modules\noty\layers\Toastr',
 *      'options' => [
 *          'closeButton' => false,
 *          'debug' => false,
 *          'newestOnTop' => true,
 *
 *          // and more for this library...
 *      ],
 *  ]);
 * ---------------------------------------
 */

class Toastr extends Layer implements LayerInterface
{

    public function run()
    {
        $view = $this->getView();
        ToastrAsset::register($view);
        parent::run();
    }

    /**
     * @inheritdoc
     */
    public function getNotification($type, $message, $options)
    {
        $type = Json::encode($type);
        $message = Json::encode($message);
        $options = Json::encode($options);

        return "toastr[$type]($message, '', $options);";
    }
}
