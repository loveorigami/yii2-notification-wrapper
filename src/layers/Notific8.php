<?php

namespace lo\modules\noty\layers;

use Yii;
use yii\helpers\Json;
use lo\modules\noty\assets\Notific8Asset;

/**
 * Class Notific8
 * @package lo\modules\noty\layers
 *
 * This widget should be used in your main layout file as follows:
 * ---------------------------------------
 *  use lo\modules\noty\Wrapper;
 *
 *  echo Wrapper::widget([
 *      'layerClass' => 'lo\modules\noty\layers\Notific8',
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
     * @var array $defaultOptions
     */
    protected $defaultOptions = [
        'life' => 5000,
        'sticky' => false,
        'horizontalEdge' => 'top',
        'verticalEdge' => 'right',
        'family' => 'legacy',
        'queue' => 'false',
    ];

    /**
     * register asset
     */
    public function run()
    {
        Notific8Asset::register($this->getView());
        parent::run();
    }


    /**
     * @param $options
     * @return string
     */
    public function getNotification($options)
    {
        $options['heading'] = $this->title;
        $options['theme'] = $this->getTheme();
        $options['icon'] = $this->getIcon();

        $options = Json::encode($options);

        return "jQuery.notific8('$this->message', $options);";
    }

    /**
     * @return string
     */
    public function getTheme()
    {
        switch ($this->type) {
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
     * @return string
     */
    public function getIcon()
    {
        switch ($this->type) {
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
