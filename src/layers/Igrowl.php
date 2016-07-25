<?php

namespace lo\modules\noty\layers;

use yii\helpers\Json;
use lo\modules\noty\assets\IgrowlAsset;

/**
 * Class Igrowl
 * @package lo\modules\noty\layers
 *
 * This widget should be used in your main layout file as follows:
 * ```php
 *  use lo\modules\noty\Wrapper;
 *
 *  echo Wrapper::widget([
 *      'layerClass' => 'lo\modules\noty\layers\Igrowl',
 *      'options' => [
 *          'placement' => [
 *              'x'=>'right',
 *              'y'=>'top',
 *          ],
 *          'animation' => true,
 *          'delay' => 3000,
 *
 *          // and more for this library...
 *      ],
 *  ]);
 * ```
 */
class Igrowl extends Layer implements LayerInterface
{
    /**
     * @var array $defaultOptions
     */
    protected $defaultOptions = [
        'placement' => [
            'x' => 'right',
            'y' => 'top',
        ],
        'animation' => true,
        'delay' => 3000,
    ];

    /**
     * register asset
     */
    public function run()
    {
        $view = $this->getView();
        IgrowlAsset::register($view);
        parent::run();
    }

    /**
     * @param $options
     * @return string
     */
    public function getNotification($options)
    {
        $options['title'] = $this->title;
        $options['message'] = $this->message;
        $options['type'] = $this->type;

        $options = Json::encode($options);

        return "$.iGrowl($options);";
    }
}
