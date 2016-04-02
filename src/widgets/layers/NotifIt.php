<?php

namespace lo\modules\noty\widgets\layers;

use yii\helpers\Json;
use lo\modules\noty\widgets\Wrapper;

/**
 * Class NotifIt
 * @package lo\modules\noty\widgets\layers
 *
 * This widget should be used in your main layout file as follows:
 * ---------------------------------------
 *  use lo\modules\noty\widgets\Wrapper;
 *
 *  echo Wrapper::widget([
 *      'layerClass' => 'lo\modules\noty\widgets\layers\NotifIt',
 *      'options' => [
 *          'multiline' => true,
 *          'position' => 'right',
 *          'append' => true,
 *          'clickable' => true,
 *
 *          // and more for this library...
 *      ],
 *  ]);
 * ---------------------------------------
 */
class NotifIt extends Wrapper implements LayerInterface
{
    /**
     * @inheritdoc
     */
    public function run()
    {
        NotifItAsset::register($this->getView());
        $this->overrideConfirm();
    }

    /**
     * @inheritdoc
     */
    public function getNotification($type, $message, $options)
    {
        $options['type'] = $type;
        $options['msg'] = $message;
        $options = Json::encode($options);

        return "notif($options);";
    }

    /**
     * Override System Confirm
     */
    public function overrideConfirm()
    {
        if ($this->overrideSystemConfirm) {

            $ok = \Yii::t('noty', 'Ok');
            $cancel = \Yii::t('noty', 'Cancel');

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