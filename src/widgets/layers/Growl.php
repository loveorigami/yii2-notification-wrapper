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
 *  echo Wrapper::widget([
 *      'layerClass' => 'lo\modules\noty\widgets\layers\Growl',
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
        $data = $options;
        $msg = explode($this->customTitleDelimeter, $message);

        if(isset($msg[1])){
            $data['message'] = $msg[1];
            $data['title'] = $msg[0];
        } else {
            $data['message'] = $message;
            $data['title'] = $this->getTitle($type);
        }

        $style = $this->getType($type);
        $msg = Json::encode($data);

        return " $.growl$style($msg);";
    }
    
    
    public function getType($type){
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
