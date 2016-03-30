<?php

namespace lo\modules\noty\widgets\layers;

use yii\helpers\Json;
use lo\modules\noty\widgets\Wrapper;

/**
 * Class PNotify
 * @package lo\modules\noty\widgets\layers
 *
 * This widget should be used in your main layout file as follows:
 * ---------------------------------------
 *  use lo\modules\noty\widgets\Wrapper;
 *
 *  echo Wrapper::widget([
 *      'layerClass' => 'lo\modules\noty\widgets\layers\PNotify',
 *      'options' => [
 *          'styling' => 'brighttheme', // jqueryui, bootstrap3, brighttheme
 *          'delay' => 3000,
 *          'icon' => true,
 *          'remove' => false,
 *          'shadow' => true,
 *          'mouse_reset' => true,
 *          'buttons' =>[
 *              'closer' => true,
 *              'sticker' => true
 *          ]
 *
 *          // and more for this library...
 *      ],
 *  ]);
 * ---------------------------------------
 */
class PNotify extends Wrapper implements LayerInterface
{
    /**
     * @inheritdoc
     */
    public function run()
    {
        PNotifyAsset::register($this->getView());
    }


    /**
     * @inheritdoc
     */
    public function getNotification($type, $message, $options)
    {
        $options['title'] = $this->getTitle($type);
        $options['type'] = $type;
        $options['text'] = $message;
        $options = Json::encode($options);

        return "new PNotify($options);";
    }

}