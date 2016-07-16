<?php

namespace lo\modules\noty\layers;

use Yii;
use yii\helpers\Json;
use lo\modules\noty\assets\LobiboxAsset;

/**
 * Class Lobibox
 * @package lo\modules\noty\layers
 *
 * This widget should be used in your main layout file as follows:
 * ```php
 *  use lo\modules\noty\Wrapper;
 *
 *  echo Wrapper::widget([
 *      'layerClass' => 'lo\modules\noty\layers\Lobibox',
 *      'layerOptions'=>[
 *          'soundPath' => false,
 *          'sound' => false
 *      ],
 *      // default options
 *      'options' => [
 *          'pauseDelayOnHover' => true,
 *          'continueDelayOnInactiveTab' => true,
 *          'delay' => 15000,  //In milliseconds,
 *          'position' => 'top right'
 *
 *          // and more for this library...
 *      ],
 *  ]);
 * ```
 */
class Lobibox extends Layer implements LayerInterface
{
    /**
     * @var string $soundsPath
     */
    public $soundPath;

    /**
     * @var bool $withSounds
     */
    public $sound = false;

    /**
     * @var array $defaultOptions
     */
    protected $defaultOptions = [
        'pauseDelayOnHover' => true,
        'continueDelayOnInactiveTab' => false,
        'delay' => 5000,
        'position' => 'top right',
    ];

    /**
     * register asset
     */
    public function init()
    {
        $view = $this->getView();
        $bundle = LobiboxAsset::register($view);
        if (!$this->soundPath) {
            $this->soundPath = $bundle->baseUrl . '/sounds/';
        }
        $this->overrideConfirm();
        parent::init();
    }

    /**
     * @param $options
     * @return string
     */
    public function getNotification($options)
    {
        $data = $options;

        $data['msg'] = $this->message;
        $data['title'] = $this->title;
        if ($this->sound) {
            $data['sound'] = $this->getSound();
            $data['soundPath'] = $this->soundPath;
        }

        $msg = Json::encode($data);

        return "Lobibox.notify('$this->type', $msg);";
    }

    /**
     * @return string|false
     */
    public function getSound()
    {
        switch ($this->type) {
            case self::TYPE_ERROR:
                $sound = 'sound4';
                break;
            case self::TYPE_INFO:
                $sound = 'sound6';
                break;
            case self::TYPE_WARNING:
                $sound = 'sound5';
                break;
            case self::TYPE_SUCCESS:
                $sound = 'sound2';
                break;
            default:
                $sound = false;
        }
        return $sound;
    }

    /**
     * Override System Confirm
     */
    public function overrideConfirm()
    {
        if ($this->overrideSystemConfirm) {

            $ok = Yii::t('noty', 'Ok');
            $cancel = Yii::t('noty', 'Cancel');
            $question = Yii::t('noty', 'Question');

            $this->view->registerJs("
                yii.confirm = function(message, ok, cancel) {
                    Lobibox.confirm({
                        title: '$question',
                        msg: message,
                        buttons: {
                            ok: {
                                text: '$ok',
                                closeOnClick: true
                            },
                            cancel: {
                                text: '$cancel',
                                closeOnClick: true
                            }
                        },
                        callback: function(lobibox, type){
                            if (type === 'cancel'){
                                !cancel || cancel();
                            } else {
                                !ok || ok();
                            }
                        }
                    });
                }
            ");
        }
    }

}
