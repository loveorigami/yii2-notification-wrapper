<?php

namespace lo\modules\noty;

use Yii;
use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\helpers\Html;
use yii\web\View;
use lo\modules\noty\layers;

/**
 * This package comes with a Wrapper widget that can be used to regularly poll the server
 * for new notifications and trigger them visually using either Toastr, or Noty.
 *
 * This widget should be used in your main layout file as follows:
 * ```php
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
 *          // for every layer (by default)
 *          'customTitleDelimiter' => '|',
 *          'overrideSystemConfirm' => true,
 *          'showTitle' => true,
 *
 *          // for custom layer
 *          'registerAnimateCss' => true,
 *          'registerButtonsCss' => true
 *      ]
 *  ]);
 * ```
 */
class Wrapper extends Widget
{
    /** @const default Layer */
    const DEFAULT_LAYER = 'lo\modules\noty\layers\Alert';

    /** @var string $layerClass */
    public $layerClass;

    /** @var array $layerOptions */
    public $layerOptions = [];

    /** @var array $options */
    public $options = [];

    /** @var bool $isAjax */
    protected $isAjax;

    /** @var string $url */
    protected $url;

    /** @var layers\LayerInterface | layers\Layer $layer */
    protected $layer;

    /**
     * init layer class
     */
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
        $this->getDiv();
        $this->registerJs();

        parent::run();
    }

    /**
     * Ajax Callback.
     * @return string|void
     */
    public function ajaxCallback()
    {
        $this->isAjax = true;
        $this->setLayer();

        return $this->getFlashes();
    }

    /**
     * Flashes
     * @return string|void
     */
    protected function getFlashes()
    {
        $session = Yii::$app->session;
        $flashes = $session->getAllFlashes();
        $options = ArrayHelper::merge($this->layer->getDefaultOptions(), $this->options);
        $result = [];

        foreach ($flashes as $type => $data) {
            if (!in_array($type, $this->layer->types)) {
                continue;
            }
            $data = (array)$data;
            foreach ($data as $i => $message) {

                $this->layer->setType($type);
                $this->layer->setTitle();
                $this->layer->setMessage($message);

                $result[] = $this->layer->getNotification($options);
            }

            $session->removeFlash($type);
        }

        if ($this->isAjax) {
            return Html::tag('script', implode("\n", $result));
        }

        return $this->view->registerJs(implode("\n", $result));
    }

    /**
     * get div, where will be placed notification
     */
    protected function getDiv()
    {
        if (!isset($this->layerOptions['layerId'])) {
            echo Html::tag('div', '', ['id' => $this->layer->getLayerId()]);
        }
    }

    /**
     * Register js for ajax notifications
     */
    protected function registerJs()
    {
        $config['options'] = $this->options;
        $config['layerOptions'] = $this->layerOptions;
        $config['layerOptions']['layerId'] = $this->layer->getLayerId();

        $config = Json::encode($config);
        $layerClass = Json::encode($this->layerClass);

        $this->view->registerJs("
            $.ajaxSetup({
                showNoty: true // default for all ajax calls
            });
            $(document).ajaxComplete(function (event, xhr, settings) {
                if (settings.showNoty && (settings.type=='POST' || settings.container)) {
                    $.ajax({
                        url: '$this->url',
                        method: 'POST',
                        cache: false,
                        showNoty: false,
                        global: false,
                        data: {
                            layerClass: '$layerClass',
                            config: '$config'
                        },
                        success: function(data) {
                           $('#" . $this->layer->getLayerId() . "').html(data);
                        }
                    });
                }
            });
        ", View::POS_END);
    }

    /**
     * load layer
     * @return layers\Layer|layers\LayerInterface|object
     */
    protected function setLayer()
    {
        $config = $this->layerOptions;
        $config['class'] = $this->layerClass;
        $this->layer = Yii::createObject($config);
        return $this->layer;
    }
}
