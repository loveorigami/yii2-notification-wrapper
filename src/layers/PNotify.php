<?php

namespace lo\modules\noty\layers;

use Yii;
use yii\helpers\Json;
use lo\modules\noty\assets\PNotifyAsset;

/**
 * Class PNotify
 * @package lo\modules\noty\layers
 *
 * This widget should be used in your main layout file as follows:
 * ---------------------------------------
 *  use lo\modules\noty\Wrapper;
 *
 *  echo Wrapper::widget([
 *      'layerClass' => 'lo\modules\noty\layers\PNotify',
 *      'options' => [
 *          'styling' => 'brighttheme', // jqueryui, bootstrap3, brighttheme
 *          'delay' => 3000,
 *          'icon' => true,
 *          'remove' => false,
 *          'shadow' => true,
 *          'mouse_reset' => true,
 *          'buttons' =>[
 *              'closer' => true,
 *              'sticker' => true
 *          ]
 *
 *          // and more for this library...
 *      ],
 *  ]);
 * ---------------------------------------
 */
class PNotify extends Layer implements LayerInterface
{
    /**
     * @var array $defaultOptions
     */
    protected $defaultOptions = [
        'styling' => 'brighttheme', // jqueryui, bootstrap3, brighttheme
        'min_height' => '16px',
        'delay' => 3000,
        'icon' => true,
        'remove' => false,
        'shadow' => true,
        'mouse_reset' => true,
        'buttons' =>[
            'closer' => true,
            'sticker' => true
        ]
    ];

    /**
     * register asset
     */
    public function run()
    {
        PNotifyAsset::register($this->getView());
        $this->overrideConfirm();
        parent::run();
    }

    /**
     * @param $options
     * @return string
     */
    public function getNotification($options)
    {
        $options['title'] = $this->title;
        $options['type'] = $this->type;
        $options['text'] = $this->message;
        $options = Json::encode($options);

        return "new PNotify($options);";
    }

    /**
     * Override System Confirm
     */
    public function overrideConfirm(){
        if ($this->overrideSystemConfirm) {
            $title = Yii::t('noty', 'Confirmation Needed');

            $this->view->registerJs("
                yii.confirm = function(message, ok, cancel) {
                    (new PNotify({
                        title: '$title',
                        text: message,
                        icon: 'glyphicon glyphicon-question-sign',
                        hide: false,
                        confirm: {
                            confirm: true
                        },
                        buttons: {
                            closer: false,
                            sticker: false
                        },
                        history: {
                            history: false
                        },
                        addclass: 'stack-modal',
                        stack: {'dir1': 'down', 'dir2': 'right', 'modal': true }
                    })).get().on('pnotify.confirm', function() {
                        !ok || ok();
                    }).on('pnotify.cancel', function() {
                        !cancel || cancel();
                    });
                }
            ");
        }
    }
}
