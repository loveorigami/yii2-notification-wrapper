<?php

namespace lo\modules\noty\widgets\layers;

use yii\helpers\Json;
use yii\web\View;
use lo\modules\noty\widgets\Wrapper;

/**
 * Class Noty
 * @package lo\modules\noty\widgets\layers
 *
 * This widget should be used in your main layout file as follows:
 * ---------------------------------------
 *  use lo\modules\noty\widgets\Wrapper;
 *
 *  echo Wrapper::widget([
 *      'layerClass' => 'lo\modules\noty\widgets\layers\Notifyjs',
 *      'options' => [
 *          'dismissQueue' => true,
 *          'layout' => 'topRight',
 *          'timeout' => 3000,
 *          'theme' => 'relax',
 *
 *          // and more for this library...
 *      ],
 *      'layerOptions'=>[
 *          'style' => 'bootstrap',
 *      ]
 *  ]);
 * ---------------------------------------
 */
class Notifyjs extends Wrapper implements LayerInterface
{
    /**
     * Register notify style
     * @var string defaults false
     */
    public $style = false;

    /**
     * @inheritdoc
     */
    public function run()
    {
        $this->registerAssets();
    }

    /**
     * @inheritdoc
     */
    public function getNotification($type, $message, $options)
    {
        switch($type){
            case self::TYPE_INFO:
                $type = "information";
                break;
        }

        $type = Json::encode($type);
        $message = Json::encode($message);

        $result[] = "var n = Noty('".self::WRAP_ID."');";
        $result[] = "$.noty.setText(n.options.id, $message);";
        $result[] = "$.noty.setType(n.options.id, $type);";

        return implode("\n", $result);
    }

    /**
     * Register required assets
     */
    public function registerAssets()
    {
        $view = $this->getView();
        $asset = NotifyjsAsset::register($view);
        $asset->style = $this->style;
    }
}