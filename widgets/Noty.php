<?php
namespace lo\modules\noty\widgets;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\base\InvalidConfigException;
use yii\helpers\Json;


/**
 * Noty.
 *
 * ```
 */

class Noty extends \lo\core\widgets\App
{

    /** @var string $url */
    public $widget = 'toastr';

    /** @var string $url */
    public $url;

    /** @var array $options */
    public $options = [];



    public function init()
    {
        parent::init();
        if (!isset($this->url) && !$this->url) {
            $this->url = Yii::$app->getUrlManager()->createUrl(['noty/default/index']);
        }

        $this->options = ($this->options) ? Json::encode($this->options) : [];

    }
    /**
     * Renders the widget.
     */
    public function run()
    {
        switch($this->widget){
            case 'toastr':
                \lavrentiev\widgets\toastr\NotificationFlash::widget([
                    'options' => Json::decode($this->options)
                ]);
                break;
            case 'noty':
                \shifrin\noty\NotyWidget::widget([
                    'options' => Json::decode($this->options),
                    'enableSessionFlash' => true,
                    'enableIcon' => true,
                    'registerAnimateCss' => false,
                    'registerButtonsCss' => false,
                    'registerFontAwesomeCss' => false,
                ]);
                break;
        }

        echo '<div id="notyjs"></div>';

        $this->view->registerJs("
        $(document).ajaxSuccess(function (event, xhr, settings) {

          if ( settings.url != '$this->url' ) {

                jQuery.ajax({
                    url: '$this->url',
                    type: 'POST',
                    cache: false,
                    data: {
                        widget: '$this->widget',
                        options: '$this->options'
                    },
                    success: function(data) {
                       $('#notyjs').html(data);
                    }
                });

            }

        });
    ", \yii\web\View::POS_END);
        
    }

}