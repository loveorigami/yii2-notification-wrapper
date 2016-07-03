<?php

namespace lo\modules\noty\widgets\layers;

use yii\helpers\Json;

/**
 * Class Toastr
 * @package lo\modules\noty\widgets\layers
 *
 * This widget should be used in your main layout file as follows:
 * ---------------------------------------
 *  use lo\modules\noty\widgets\Wrapper;
 *
 *  echo Wrapper::widget([
 *      'layerClass' => 'lo\modules\noty\widgets\layers\Toastr',
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
        $asset = ToastrAsset::register($view);
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
