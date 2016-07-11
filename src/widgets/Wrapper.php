<?php

namespace lo\modules\noty\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Json;
use yii\helpers\Html;
use yii\web\View;

/**
 * This package comes with a Wrapper widget that can be used to regularly poll the server
 * for new notifications and trigger them visually using either Toastr, or Noty.
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
 *          // for every layer (by default)
 *          'customTitleDelimiter' => '|',
 *          'overrideSystemConfirm' => true,
 *
 *          // for custom layer
 *          'registerAnimateCss' => true,
 *          'registerButtonsCss' => true
 *      ]
 *  ]);
 * ---------------------------------------
 */
class Wrapper extends Widget
{
    /**
     * @const wrapper id
     */
    const WRAP_ID = 'noty-wrap';

    /**
     * @const default Layer
     */
    const DEFAULT_LAYER = 'lo\modules\noty\widgets\layers\Alert';

    /**
     * @var string $layerClass
     */
    public $layerClass;

    /**
     * @var array $layerOptions
     */
    public $layerOptions = [];

    /**
     * @var array $options
     */
    public $options = [];

    /**
     * @var bool $isAjax
     */
    protected $isAjax;

    /**
     * @var string $url
     */
    protected $url;

    /**
     * @var \lo\modules\noty\widgets\layers\LayerInterface $layer
     */
    protected $layer;

    public function init()
    {
        parent::init();

        $this->url = Yii::$app->getUrlManager()->createUrl(['noty/default/index']);
        
        if (!$this->layerClass) {
            $this->layerClass = self::DEFAULT_LAYER;
        }
    }

    /**
     * Renders the widget.
     */
    public function run()
    {
        $this->isAjax = false;

        $layer = $this->setLayer();
        $layer::widget($this->layerOptions);

        $this->getFlashes();
        $this->registerJs();

        parent::run();
    }

    /**
     * Ajax Callback.
     */
    public function ajaxCallback()
    {
        $this->isAjax = true;
        $this->setLayer();

        return $this->getFlashes();
    }

    /**
     * Flashes
     */
    protected function getFlashes()
    {
        $session = Yii::$app->session;
        $flashes = $session->getAllFlashes();
        $options = $this->options;
        $result = [];

        foreach ($flashes as $type => $data) {
            $type = $this->layer->getType($type);
            $data = (array)$data;
            foreach ($data as $i => $message) {
                $result[] = $this->layer->getNotification($type, $message, $options);
            }

            $session->removeFlash($type);
        }

        if ($this->isAjax) {
            return Html::tag('script', implode("\n", $result));
        }

        return $this->view->registerJs(implode("\n", $result));
    }

    /**
     * Register js for ajax notifications
     */
    protected function registerJs()
    {
        echo Html::tag('div', '', ['id' => self::WRAP_ID]);

        $config['options'] = $this->options;
        $config['layerOptions'] = $this->layerOptions;

        $config = Json::encode($config);
        $layerClass = Json::encode($this->layerClass);

        $this->view->registerJs("
            $(document).ajaxComplete(function (event, xhr, settings) {
              if (settings.url != '$this->url' ) {
                    $.ajax({
                        url: '$this->url',
                        type: 'POST',
                        cache: false,
                        data: {
                            layerClass: '$layerClass',
                            config: '$config'
                        },
                        success: function(data) {
                           $('#" . self::WRAP_ID . "').html(data);
                        }
                    });
                }
            });
        ", View::POS_END);
    }
    
    /**
     * load layer
     */
    protected function setLayer()
    {
        $config = $this->layerOptions;
        $config['class'] = $this->layerClass;
        $this->layer = Yii::createObject($config);
        return $this->layer;
    }
}
