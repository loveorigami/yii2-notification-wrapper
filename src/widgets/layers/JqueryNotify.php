<?php

namespace lo\modules\noty\widgets\layers;

use yii\helpers\Json;

/**
 * Class JqueryNotify
 * @package lo\modules\noty\widgets\layers
 *
 * This widget should be used in your main layout file as follows:
 * ---------------------------------------
 *  use lo\modules\noty\widgets\Wrapper;
 *
 *  echo Wrapper::widget([
 *      'layerClass' => 'lo\modules\noty\widgets\layers\JqueryNotify',
 *      'options' => [
 *         'theme' => 'default', // or 'dark-theme'
 *              'position' =>[
 *                  'x' => 'right',
 *                  'y' => 'top'
 *              ],
 *          'overlay' => false,
 *          'overflowHide' => false,
 *          'autoHide' => true,
 *
 *          // and more for this library
 *      ],
 *  ]);
 * ---------------------------------------
 */
class JqueryNotify extends Layer implements LayerInterface
{
    /**
     * @inheritdoc
     */
    public function run()
    {
        JqueryNotifyAsset::register($this->getView());
    }


    /**
     * @inheritdoc
     */
    public function getNotification($type, $message, $options)
    {
        $options['type'] = $type;
        $options['title'] = $this->getTitle($type);
        $options['message'] = $message;
        $options = Json::encode($options);

        return "notify($options);";
    }
}
