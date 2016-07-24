<?php

namespace lo\modules\noty\layers;

use Yii;
use yii\helpers\Json;
use lo\modules\noty\assets\SweetalertAsset;

/**
 * Class Sweetalert
 * @package lo\modules\noty\layers
 *
 * This widget should be used in your main layout file as follows:
 * ```php
 *  use lo\modules\noty\Wrapper;
 *
 *  echo Wrapper::widget([
 *      'layerClass' => 'lo\modules\noty\layers\Sweetalert',
 *      'layerOptions' => [
 *          'theme' => 'twitter' // facebook, google, twitter
 *      ],
 *      'options' => [
 *          'showCancelButton' => false,
 *          'closeOnConfirm' => false,
 *          'disableButtonsOnConfirm' => true,
 *          'html' => false
 *
 *          // and more for this library...
 *      ],
 *  ]);
 * ```
 */
class Sweetalert extends Layer implements LayerInterface
{
    /**
     * Theme as facebook, google, twitter
     * @var string
     */
    public $theme;

    /**
     * @var array $defaultOptions
     */
    protected $defaultOptions = [
        'showCancelButton' => true,
        'closeOnConfirm' => false,
        'disableButtonsOnConfirm' => true,
        'html' => false
    ];

    /**
     * register asset
     */
    public function run()
    {
        $this->registerAssets();
        $this->overrideConfirm();
        parent::run();
    }

    /**
     * Register required assets
     */
    public function registerAssets()
    {
        $view = $this->getView();
        $bundle = SweetalertAsset::register($view);
        $bundle->theme = $this->theme;
    }

    /**
     * @param $options
     * @return string
     */
    public function getNotification($options)
    {
        $options['title'] = $this->title;
        $options['text'] = $this->message;
        $options['type'] = $this->type;

        $options = Json::encode($options);

        return "swal($options);";
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
                    swal({
                      title: '$question',
                      text: message,
                      type: 'warning',
                      showCancelButton: true,
                      confirmButtonText: '$ok',
                      cancelButtonText: '$cancel',
                      closeOnConfirm: true,
                      html: false
                    }, function(){
                        !ok || ok();
                    });
                }
            ");
        }
    }
}
