<?php

namespace lo\modules\noty\layers;

use Yii;
use yii\helpers\Json;
use lo\modules\noty\assets\NotieAsset;

/**
 * Class Notie
 * @package lo\modules\noty\layers
 *
 * This widget should be used in your main layout file as follows:
 * ---------------------------------------
 *  use lo\modules\noty\Wrapper;
 *
 *  echo Wrapper::widget([
 *      'layerClass' => 'lo\modules\noty\layers\Notie',
 *      'options' => [
 *          'colorSuccess' => '#57BF57',
 *          'colorWarning' => '#D6A14D',
 *          'colorError' => '#E1715B',
 *          'colorInfo' => '#4D82D6',
 *          'colorNeutral' => '#A0A0A0',
 *          'colorText' => '#FFFFFF',
 *          'animationDelay' => 300, // Be sure to also change "transition: all 0.3s ease" variable in .scss file
 *          'backgroundClickDismiss' => true
 *
 *          // and more for this library...
 *      ],
 *  ]);
 * ---------------------------------------
 */
class Notie extends Layer implements LayerInterface
{
    /**
     * @var array $defaultOptions
     */
    protected $defaultOptions = [
        'colorSuccess' => '#000',
        'colorWarning' => '#D6A14D',
        'colorError' => '#E1715B',
        'colorInfo' => '#4D82D6',
        'colorNeutral' => '#A0A0A0',
        'colorText' => '#FFFFFF',
        'animationDelay' => 3,
        'backgroundClickDismiss' => true
    ];

    /**
     * register asset
     */
    public function run()
    {
        $view = $this->getView();
        NotieAsset::register($view);
        $this->overrideConfirm();
        parent::run();
    }

    /**
     * @param $options
     * @return string
     */
    public function getNotification($options)
    {
        $style = $this->getStyle();
        $options = Json::encode($options);

        $js[] = "notie.setOptions($options);";
        $js[] = "notie.alert($style, '$this->message');";

        return implode($js,"\r\n");

    }

    /**
     * @return string
     */
    public function getStyle(){
        switch ($this->type) {
            case self::TYPE_ERROR:
                $style = 3;
                break;
            case self::TYPE_SUCCESS:
                $style = 1;
                break;
            case self::TYPE_WARNING:
                $style = 2;
                break;
            default:
                $style = 4;
        }
        return $style;
    }

    /**
     * Override System Confirm
     */
    public function overrideConfirm()
    {
        if ($this->overrideSystemConfirm) {

            $ok = Yii::t('noty', 'Ok');
            $cancel = Yii::t('noty', 'Cancel');

            $this->view->registerJs("
                yii.confirm = function(message, ok, cancel) {
                
                    notie.confirm(message, '$ok', '$cancel', function() {
                        !ok || ok();
                    });
                    
                }
            ");
        }
    }
}
