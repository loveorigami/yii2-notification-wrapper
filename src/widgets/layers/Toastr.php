<?php

namespace lo\modules\noty\widgets\layers;

use yii\helpers\Json;
use lo\modules\noty\widgets\Wrapper;

/**
 * Class Toastr
 * @package lo\modules\noty\widgets\layers
 *
 * This widget should be used in your main layout file as follows:
 * ---------------------------------------
 *  use lo\modules\noty\widgets\Wrapper;
 *
 *  Wrapper::widget([
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

class Toastr extends Wrapper
{

    public function run()
    {
        $view = $this->getView();
        $asset = ToastrAsset::register($view);
    }

    /**
     * @inheritdoc
     */
    public function setNotification($type, $message, $options)
    {
        return "toastr[$type]($message, '', $options);";
    }
}