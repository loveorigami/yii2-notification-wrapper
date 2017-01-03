<?php

namespace lo\modules\noty\layers;

use yii\helpers\Json;
use lo\modules\noty\assets\JqueryToasterAsset;

/**
 * Class JqueryToastr
 * @package lo\modules\noty\layers
 *
 * This widget should be used in your main layout file as follows:
 * ---------------------------------------
 *  use lo\modules\noty\Wrapper;
 *
 *  echo Wrapper::widget([
 *      'layerClass' => 'lo\modules\noty\layers\JqueryToastr',
 *      'options' => [
 *          'settings' => [
 *              'toaster' => [
 *                  'css' => [
 *                      'position' => 'fixed',
 *                      'top' => '10px',
 *                      'right' => '10px',
 *                      'width' => '300px',
 *                      'zIndex' => 50000
 *                  ],
 *              ],
 *              'toast' => [
 *                  'fade' => 'slow',
 *              ],
 *              'timeout' => 3000
 *
 *          // and more for this library...
 *      ],
 *  ]);
 * ---------------------------------------
 */
class JqueryToaster extends Layer implements LayerInterface
{
    /**
     * @var array $defaultOptions
     */
    protected $defaultOptions = [
        'settings' => [
            'toaster' => [
                'css' => [
                    'position' => 'fixed',
                    'top' => '10px',
                    'right' => '10px',
                    'width' => '300px',
                    'zIndex' => 50000
                ],
            ],
            'toast' => [
                'fade' => 'slow',
            ],
            'timeout' => 3000
        ]
    ];

    /**
     * register asset
     */
    public function run()
    {
        $view = $this->getView();
        JqueryToasterAsset::register($view);
        parent::run();
    }

    /**
     * @param $options
     * @return string
     */
    public function getNotification($options)
    {
        $options['priority'] = $this->getStyle();
        $options['message'] = $this->getMessageWithTitle();

        $options = Json::encode($options);

        return "$.toaster($options);";
    }

    /**
     * @return string
     */
    public function getStyle()
    {
        switch ($this->type) {
            case self::TYPE_ERROR:
                $style = "danger";
                break;
            default:
                $style = $this->type;
        }
        return $style;
    }
}
