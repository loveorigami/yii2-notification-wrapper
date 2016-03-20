<?php
namespace lo\modules\noty\widgets;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\base\InvalidConfigException;


/**
 * Noty.
 *
 * ```
 */

class Noty extends \lo\core\widgets\App
{

    public $source = 'toastr';
    public $url;

    public function init()
    {
        parent::init();
        if (!isset($this->url) && !$this->url) {
            $this->url = Yii::$app->getUrlManager()->createUrl(['noty/default/index']);
        }
    }
    /**
     * Renders the widget.
     */
    public function run()
    {
        switch($this->source){
            case 'toastr':
                \lavrentiev\widgets\toastr\NotificationFlash::widget();
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
                    data: { source: '$this->source' },
                    success: function(data) {
                       $('#notyjs').html(data);
                    }
                });

            }

        });
    ", \yii\web\View::POS_END);
        
    }

}