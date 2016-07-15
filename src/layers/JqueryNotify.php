<?php

namespace lo\modules\noty\layers;

use yii\helpers\Json;
use lo\modules\noty\assets\JqueryNotifyAsset;

/**
 * Class JqueryNotify
 * @package lo\modules\noty\layers
 *
 * This widget should be used in your main layout file as follows:
 * ---------------------------------------
 *  use lo\modules\noty\Wrapper;
 *
 *  echo Wrapper::widget([
 *      'layerClass' => 'lo\modules\noty\layers\JqueryNotify',
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
     * @var array $defaultOptions
     */
    protected $defaultOptions = [
        'theme' => 'default', // or 'dark-theme'
        'position' =>[
            'x' => 'right',
            'y' => 'top'
        ],
        'overlay' => false,
        'overflowHide' => false,
        'autoHide' => true,
    ];

    /**
     * register asset
     */
    public function run()
    {
        JqueryNotifyAsset::register($this->getView());
        parent::run();
    }

    /**
     * @param $options
     * @return string
     */
    public function getNotification($options)
    {
        $options['type'] = $this->type;
        $options['title'] = $this->title;
        $options['message'] = $this->message;
        $options = Json::encode($options);

        return "notify($options);";
    }
}
