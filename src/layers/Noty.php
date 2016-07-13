<?php

namespace lo\modules\noty\layers;

use Yii;
use yii\helpers\Json;
use lo\modules\noty\assets\NotyAsset;

/**
 * Class Noty
 * @package lo\modules\noty\layers
 *
 * This widget should be used in your main layout file as follows:
 * ---------------------------------------
 *  use lo\modules\noty\Wrapper;
 *
 *  echo Wrapper::widget([
 *      'layerClass' => 'lo\modules\noty\layers\Noty',
 *      'options' => [
 *          'dismissQueue' => true,
 *          'layout' => 'topRight',
 *          'timeout' => 3000,
 *          'theme' => 'relax',
 *
 *          // and more for this library...
 *      ],
 *      'layerOptions'=>[
 *          'registerAnimateCss' => true,
 *          'registerButtonsCss' => true
 *      ]
 *  ]);
 * ---------------------------------------
 */
class Noty extends Layer implements LayerInterface
{
    /**
     * Register animate.css
     * If animate.css already registered in your assets you can set it to false
     * @var bool defaults true
     */
    public $registerAnimateCss = false;

    /**
     * Register buttons.css
     * If bootstrap.css or any related css already registered in your assets you can set it to false,
     * otherwise this will override your buttons' styles
     * @var bool defaults true
     */
    public $registerButtonsCss = false;

    /**
     * @inheritdoc
     */
    public function run()
    {
        $this->registerAssets();
        $this->overrideConfirm();
        parent::run();
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

        $options['type'] = $type;
        $options['text'] = $message;

        $options = Json::encode($options);
        return "noty($options);";

    }

    /**
     * Register required assets
     */
    public function registerAssets()
    {
        $view = $this->getView();
        $asset = NotyAsset::register($view);
        $asset->animateCss = $this->registerAnimateCss;
        $asset->buttonsCss = $this->registerButtonsCss;
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
                    noty({
                        text: message,
                        type: 'confirm',
                        layout: 'center',
                        modal: true,
                        buttons: [
                            {
                                addClass: 'btn btn-primary',
                                text: '$ok',
                                onClick: function(res) {
                                    !ok || ok();
                                    res.close();
                                }
                            },
                            {
                                addClass: 'btn btn-danger',
                                text: '$cancel',
                                onClick: function(res) {
                                    !cancel || cancel();
                                    res.close();
                                }
                            }
                        ]
                    });
                }
            ");
        }
    }
}
