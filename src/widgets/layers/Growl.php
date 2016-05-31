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
        $data['message'] = $message;
        $data['title'] = $this->getTitle($type);

        switch ($type) {
            case self::TYPE_ERROR:
                $type = '.error';
                break;
            case self::TYPE_SUCCESS:
                $type = '.notice';
                break;
            case self::TYPE_WARNING:
                $type = '.warning';
                break;
            default:
                $type = '';
        }

        $msg = Json::encode($data);

        return " $.growl$type($msg);";
    }
}
