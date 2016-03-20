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
    public $url = '';

    public function init()
    {
        parent::init();
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

        $this->view->registerJs("
        $(document).ajaxSuccess(function (event, xhr, settings) {
            //var n = Noty('log');
            //$.noty.setText(n.options.id, 'log data');
            //$.noty.setType(n.options.id, 'info');
            toastr.info('test', 'info');
        });
    ", \yii\web\View::POS_END);
        
    }

}