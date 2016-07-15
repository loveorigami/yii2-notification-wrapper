<?php

namespace lo\modules\noty\layers;

use yii\helpers\Json;
use lo\modules\noty\assets\GrowlAsset;

/**
 * Class Growl
 * @package lo\modules\noty\layers
 *
 * This widget should be used in your main layout file as follows:
 * ---------------------------------------
 *  use lo\modules\noty\Wrapper;
 *
 *  echo Wrapper::widget([
 *      'layerClass' => 'lo\modules\noty\layers\Growl',
 *      'options' => [
 *          'fixed' => true,
 *          'size' => 'medium',
 *          'location' => 'tr',
 *          'delayOnHover' => true,
 *
 *          // and more for this library...
 *      ],
 *  ]);
 * ---------------------------------------
 */
class Growl extends Layer implements LayerInterface
{

    /**
     * @var array $defaultOptions
     */
    protected $defaultOptions = [
        'fixed' => true,
        'size' => 'medium',
        'location' => 'tr',
        'delayOnHover' => true,
    ];

    /**
     * register asset
     */
    public function run()
    {
        $view = $this->getView();
        GrowlAsset::register($view);
        parent::run();
    }


    /**
     * @param $options
     * @return string
     */
    public function getNotification($options)
    {
        $data = $options;

        $data['message'] = $this->message;
        $data['title'] = $this->title;

        $style = $this->getStyle();
        $msg = Json::encode($data);

        return " $.growl$style($msg);";
    }


    /**
     * @return string
     */
    public function getStyle()
    {
        switch ($this->type) {
            case self::TYPE_ERROR:
                $style = '.error';
                break;
            case self::TYPE_SUCCESS:
                $style = '.notice';
                break;
            case self::TYPE_WARNING:
                $style = '.warning';
                break;
            default:
                $style = '';
        }
        return $style;
    }
}
