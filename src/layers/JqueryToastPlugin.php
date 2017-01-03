<?php

namespace lo\modules\noty\layers;

use lo\modules\noty\assets\JqueryToastPluginAsset;
use yii\helpers\Json;

/**
 * Class JqueryToastPlugin
 * @package lo\modules\noty\layers
 *
 * This widget should be used in your main layout file as follows:
 * ---------------------------------------
 *  use lo\modules\noty\Wrapper;
 *
 *  echo Wrapper::widget([
 *      'layerClass' => 'lo\modules\noty\layers\JqueryToastPlugin',
 *      'options' => [
 *          'position' => 'top-right',
 *          'hideAfter' => 3000,
 *          'allowToastClose' => true,
 *
 *          // and more for this library...
 *      ],
 *  ]);
 * ---------------------------------------
 */
class JqueryToastPlugin extends Layer implements LayerInterface
{
    /**
     * @var array $defaultOptions
     */
    protected $defaultOptions = [
        'showHideTransition' => 'slide',  // It can be plain, fade or slide
        'allowToastClose' => 'true', // Show the close button or not
        'hideAfter' => 3000, // `false` to make it sticky or time in miliseconds to hide after
        'stack' => 5, // `false` to show one stack at a time count showing the number of toasts that can be shown at once
        'position' => 'top-right', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values to position the toast on page
    ];

    /**
     * register asset
     */
    public function run()
    {
        $view = $this->getView();
        JqueryToastPluginAsset::register($view);
        parent::run();
    }

    /**
     * @param $options
     * @return string
     */
    public function getNotification($options)
    {
        $options['icon'] = $this->type;
        $options['text'] = $this->getMessageWithTitle();
        $options = Json::encode($options);

        return "$.toast($options);";
    }
}
