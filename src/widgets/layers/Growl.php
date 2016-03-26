<?php

namespace lo\modules\noty\widgets\layers;

use yii\helpers\Json;
use yii\web\View;
use lo\modules\noty\widgets\Wrapper;

/**
 * Class Growl
 * @package lo\modules\noty\widgets\layers
 *
 * This widget should be used in your main layout file as follows:
 * ---------------------------------------
 *  use lo\modules\noty\widgets\Wrapper;
 *
 *  Wrapper::widget([
 *      'layerClass' => 'lo\modules\noty\widgets\layers\Growl',
 *      'options' => [
 *          'dismissQueue' => true,
 *          'layout' => 'topRight',
 *          'timeout' => 3000,
 *          'theme' => 'relax',
 *
 *          // and more for this library...
 *      ],
 *  ]);
 * ---------------------------------------
 */
class Growl extends Wrapper implements LayerInterface
{

    public function run()
    {
        $view = $this->getView();
        $asset = GrowlAsset::register($view);
    }

    /**
     * @inheritdoc
     */
    public function getNotification($type, $message, $options)
    {
        return "growl[$type]($message, '', $options);";
    }
}