<?php

namespace lo\modules\noty\widgets\layers;

use Yii;
use yii\helpers\Json;

/**
 * Class Notific8
 * @package lo\modules\noty\widgets\layers
 *
 * This widget should be used in your main layout file as follows:
 * ---------------------------------------
 *  use lo\modules\noty\widgets\Wrapper;
 *
 *  echo Wrapper::widget([
 *      'layerClass' => 'lo\modules\noty\widgets\layers\Notific8',
 *      'options' => [
 *          'life' => 5000,
 *          'sticky' => false,
 *          'horizontalEdge' => 'top',
 *          'verticalEdge' => 'right',
 *          'family' => 'legacy', // legacy, chicchat, atomic
 *
 *          // and more for this library https://github.com/ralivue/notific8/wiki/Options
 *      ],
 *  ]);
 * ---------------------------------------
 */
class Notific8 extends Layer implements LayerInterface
{
    /**
     * @inheritdoc
     */
    public function run()
    {
        Notific8Asset::register($this->getView());
    }


    /**
     * @param $type
     * @param $message
     * @param $options
     * @return string
     */
    public function getNotification($type, $message, $options)
    {
        $options['heading'] = $this->getTitle($type);
        $options['theme'] = $this->getTheme($type);
        $options['icon'] = $this->getIcon($type);

        $options = Json::encode($options);

        return "jQuery.notific8('$message', $options);";
    }

    /**
     * @param $type
     * @return string
     */
    public function getTheme($type)
    {
        switch ($type) {
            case self::TYPE_ERROR:
                $theme = 'ruby';
                break;
            case self::TYPE_INFO:
                $theme = 'teal';
                break;
            case self::TYPE_WARNING:
                $theme = 'tangerine';
                break;
            case self::TYPE_SUCCESS:
                $theme = 'lime';
                break;
            default:
                $theme = 'smoke';
        }

        return $theme;
    }

    /**
     * @param $type
     * @return string
     */
    public function getIcon($type)
    {
        switch ($type) {
            case self::TYPE_ERROR:
                $icon = 'code';
                break;
            case self::TYPE_INFO:
                $icon = 'pencil';
                break;
            case self::TYPE_WARNING:
                $icon = 'magic-wand';
                break;
            case self::TYPE_SUCCESS:
                $icon = 'check-mark-2';
                break;
            default:
                $icon = 'star';
        }

        return $icon;
    }
}
