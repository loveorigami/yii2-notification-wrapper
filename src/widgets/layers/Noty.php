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
 *      'layerClass' => 'lo\modules\noty\widgets\layers\Noty',
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
class Noty extends Wrapper implements LayerInterface
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
        $this->registerPlugin();
        $this->overrideConfirm();
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
     * Register Noty plugin by creating a wrapper function called 'Noty()'
     * This will be available globally for use
     *
     * ~~~
     * js: var n = Noty('id');
     * $.noty.setText(n.options.id, 'Hi I am noty alert!');
     * $.noty.setType(n.options.id, 'information');
     * ~~~
     */
    public function registerPlugin()
    {
        $view = $this->getView();
        $options = ($this->options) ? Json::encode($this->options) : "{}";
        $js = <<< JS
            function Noty(widgetId, options) {
                var finalOptions = $.extend({}, $options, options);
                return noty(finalOptions);
            }
JS;

        $view->registerJs($js, View::POS_END);
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
     * Override Sistem Confirm
     */
    public function overrideConfirm()
    {
        if ($this->overrideSystemConfirm) {

            $ok = \Yii::t('noty', 'Ok');
            $cancel = \Yii::t('noty', 'Cancel');

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