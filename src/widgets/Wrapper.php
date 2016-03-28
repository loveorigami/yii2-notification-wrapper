<?php
namespace lo\modules\noty\widgets;

use Yii;
use yii\web\View;
use yii\helpers\Json;
use yii\helpers\Html;
use yii\base\InvalidParamException;

/**
 * This package comes with a Wrapper widget that can be used to regularly poll the server
 * for new notifications and trigger them visually using either Toastr, or Noty.
 *
 * This widget should be used in your main layout file as follows:
 * ---------------------------------------
 *  use lo\modules\noty\widgets\Wrapper;
 *
 *  Wrapper::widget([
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

    /** @const wrapper id */
    const WRAP_ID = 'noty-wrap';

    /** @const default Layer */
    const DEFAULT_LAYER = 'lo\modules\noty\widgets\layers\Alert';

    /** @var array $types */
    public $types = [self::TYPE_INFO, self::TYPE_ERROR, self::TYPE_SUCCESS, self::TYPE_WARNING];

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


    public function init()
    {
        parent::init();

        $this->url = Yii::$app->getUrlManager()->createUrl(['noty/default/index']);
    }

    /**
     * Renders the widget.
     */
    public function run()
    {
        if (!$this->layerClass) {
            $this->layerClass = self::DEFAULT_LAYER;
        }

        $this->isAjax = false;

        $config = $this->layerOptions;
        $config['options'] = $this->options;
        $config['layerClass'] = $this->layerClass;

        $layer = $this->loadLayer();
        $layer::widget($config);
        $this->getFlashes($layer);

        echo Html::tag('div', '', ['id' => self::WRAP_ID]);

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
                           $('#" . self::WRAP_ID . "').html(data);
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
        $options = $this->options;
        $result = [];

        foreach ($flashes as $type => $data) {
            $data = (array)$data;
            $type = (in_array($type, $this->types)) ? $type : self::TYPE_INFO;

            foreach ($data as $i => $message) {
                $result[] = $layer->getNotification($type, $message, $options);
            }

            $session->removeFlash($type);
        }

        if ($this->isAjax) {
            return Html::tag('script', implode("\n", $result));
        }

        return $this->view->registerJs(implode("\n", $result));
    }

    /**
     * Get title
     */
    public function getTitle($type)
    {
        switch ($type) {
            case self::TYPE_ERROR:
                $t = \Yii::t('noty', 'Error');
                break;
            case self::TYPE_INFO:
                $t = \Yii::t('noty', 'Info');
                break;
            case self::TYPE_WARNING:
                $t = \Yii::t('noty', 'Warning');
                break;
            case self::TYPE_SUCCESS:
                $t = \Yii::t('noty', 'Success');
                break;
            default:
                $t = '';
        }

        return $t;
    }

    /**
     * load layer
     */
    protected function loadLayer()
    {
        $layer = new $this->layerClass;
        return $layer;
    }
}