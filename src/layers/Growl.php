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
 *          'style' => 'default',
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
     * register asset
     */
    public function run()
    {
        $view = $this->getView();
        GrowlAsset::register($view);
        parent::run();
    }


    /**
     * @param $type
     * @param $message
     * @param $options
     * @return string
     */
    public function getNotification($type, $message, $options)
    {
        $data = $options;
        $msg = explode($this->customTitleDelimiter, $message);

        if(isset($msg[1])){
            $data['message'] = $msg[1];
            $data['title'] = $msg[0];
        } else {
            $data['message'] = $message;
            $data['title'] = $this->getTitle($type);
        }

        $style = $this->getStyle($type);
        $msg = Json::encode($data);

        return " $.growl$style($msg);";
    }
    
    
    /**
     * @param $type
     * @return string
     */
    public function getStyle($type){
        switch ($type) {
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
