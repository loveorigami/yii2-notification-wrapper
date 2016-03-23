<?php
namespace lo\modules\noty\widgets;

use Yii;
use yii\base\InvalidConfigException;
use yii\web\View;
use yii\helpers\Json;
use yii\helpers\Html;

/**
 * This package comes with a Wrapper widget that can be used to regularly poll the server for new notifications and trigger them visually using either Toastr, or Noty.
 *
 * This widget should be used in your main layout file as follows:
 * ---------------------------------------
 *  use lo\modules\noty\widgets\Wrapper;
 *
 *  Wrapper::widget([
 *      'layer' => 'lo\modules\noty\widgets\layers\Noty',
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

class Wrapper extends \yii\base\Widget
{
    /** @const type info */
    const TYPE_INFO = 'info';

    /** @const type error */
    const TYPE_ERROR = 'error';

    /** @const type success */
    const TYPE_SUCCESS = 'success';

    /** @const type warning */
    const TYPE_WARNING = 'warning';

    /** @const type wrapper id */
    const WRAP_ID = 'noty-js';


    /** @var string $types */
    public $types = [self::TYPE_INFO, self::TYPE_ERROR, self::TYPE_SUCCESS, self::TYPE_WARNING];

    /** @var string $url */
    public $url;

    /** @var string $class */
    public $layerClass;

    /** @var array $options */
    public $layerOptions = [];

    /**
     * Tag Html attributes
     * @var array()
     */
    public $htmlOptions=[];

    /** @var array $options */
    public $options = [];

    /** @var string $typeDefault */
    protected $isAjax;


    public function init()
    {
        parent::init();

        if (!$this->url) {
            $this->url = Yii::$app->getUrlManager()->createUrl(['noty/default/index']);
        }

        if (!isset($this->htmlOptions['id'])) {
            $this->htmlOptions['id'] = self::WRAP_ID;
        } else {
            $this->id = $this->htmlOptions['id'];
        }
    }

    /**
     * Renders the widget.
     */
    public function run()
    {
        $this->isAjax = false;

        $config = $this->layerOptions;
        $config['options'] = $this->options;
        $config['layerClass'] = $this->layerClass;

        $layer = $this->loadLayer();
        $layer::widget($config);
		$this->getFlashes($layer);

        echo Html::tag('div', '', $this->htmlOptions);

        $options = Json::encode($this->options);
        $layerClass = Json::encode($this->layerClass);

        $this->view->registerJs("
            $(document).ajaxSuccess(function (event, xhr, settings) {
              if (settings.url != '$this->url' ) {
                    $.ajax({
                        url: '$this->url',
                        type: 'POST',
                        cache: false,
                        data: {
                            layerClass: '$layerClass',
                            options: '$options'
                        },
                        success: function(data) {
                           $('#{$this->htmlOptions['id']}').html(data);
                        }
                    });
                }
            });
        ", View::POS_END);

    }

    /**
     * Ajax Callback.
     */
    public function ajaxCallback()
    {
        $this->isAjax = true;
        $layer = $this->loadLayer();

        return $this->getFlashes($layer);
    }

    /**
     * Flashes
     */
    protected function getFlashes($layer)
    {
        $session = \Yii::$app->session;
        $flashes = $session->getAllFlashes();
        $options = Json::encode($this->options);
        $result = [];

        foreach ($flashes as $type => $data) {
            $data = (array)$data;
            $type = (in_array($type, $this->types)) ? $type : self::TYPE_INFO;

            foreach ($data as $i => $message) {
                $message = Json::encode($message);
                $type = Json::encode($type);
                $result[] = $layer->setNotification($type, $message, $options);
            }

            $session->removeFlash($type);
        }

        if($this->isAjax){
            return Html::tag('script', implode("\n", $result));
        }

        return $this->view->registerJs(implode("\n", $result));
    }

    protected function loadLayer(){
        $layer = new $this->layerClass;
        return $layer;
    }

}