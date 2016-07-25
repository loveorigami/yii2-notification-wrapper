<?php

namespace lo\modules\noty\layers;

use Yii;
use yii\helpers\Json;
use lo\modules\noty\assets\NotifItAsset;

/**
 * Class NotifIt
 * @package lo\modules\noty\layers
 *
 * This widget should be used in your main layout file as follows:
 * ```php
 *  use lo\modules\noty\Wrapper;
 *
 *  echo Wrapper::widget([
 *      'layerClass' => 'lo\modules\noty\layers\NotifIt',
 *      'options' => [
 *          'multiline' => true,
 *          'position' => 'center',
 *          'width' => 'all',
 *          'append' => true,
 *          'clickable' => true,
 *
 *          // and more for this library...
 *      ],
 *  ]);
 * ```
 */
class NotifIt extends Layer implements LayerInterface
{
    /**
     * @var array $defaultOptions
     */
    protected $defaultOptions = [
        'multiline' => true,
        'position' => 'center',
        'width' => 'all',
        'append' => true,
        'clickable' => true,
    ];

    /**
     * register asset
     */
    public function run()
    {
        NotifItAsset::register($this->getView());
        $this->overrideConfirm();
        parent::run();
    }


    /**
     * @param $options
     * @return string
     */
    public function getNotification($options)
    {
        $options['type'] = $this->type;
        $options['msg'] = $this->message;
        $options = Json::encode($options);

        return "notif($options);";
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

                    notif_confirm({
                        'message': message,
                        'textaccept': '$ok',
                        'textcancel': '$cancel',
                        'callback': function(choice){
                            if(choice){
                                !ok || ok();
                            } else{
                                !cancel || cancel();
                            }
                        }
                    })

                }
            ");
        }
    }
}
