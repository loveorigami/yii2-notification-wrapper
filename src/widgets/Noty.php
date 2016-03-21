<?php
namespace lo\modules\noty\widgets;

use Yii;
use yii\base\InvalidConfigException;
use yii\helpers\Json;


/**
 * Noty.
This package comes with a NotyWidget that can be used to regularly poll the server for new notifications and trigger them visually using either Toastr, or Noty.

This widget should be used in your main layout file as follows:

```php
use lo\modules\noty\widgets\Noty;

Noty::widget([
    'theme' => Noty::THEME_TOASTR,
    'options' => [
        'closeButton' => false,
        'debug' => false,
        'newestOnTop' => true,

        // and more for this library

        "progressBar" => false,
        "positionClass" => "toast-top-left",
        "preventDuplicates" => false,
        "onclick" => null,
        "showDuration" => "300",
        "hideDuration" => "1000",
        "timeOut" => "5000",
        "extendedTimeOut" => "1000",
        "showEasing" => "swing",
        "hideEasing" => "linear",
        "showMethod" => "fadeIn",
        "hideMethod" => "fadeOut"

    ],
]);
```
 */

class Noty extends \yii\base\Widget
{

    /**
     * Use Noty
     * @see http://ned.im/noty/
     * @see https://github.com/Shifrin/yii2-noty
     */
    const THEME_NOTY = 'noty';

    /**
     * Use Toastr
     * @see https://github.com/CodeSeven/toastr
     * @see https://github.com/lavrentiev/yii2-toastr
     */
    const THEME_TOASTR = 'toastr';

    /**
     * @var string the library name to be used for notifications
     * One of the THEME_XXX constants
     */
    public $theme = self::THEME_TOASTR;

    /**
     * @var array List of built in themes
     */
    protected static $_builtinThemes = [
        self::THEME_NOTY,
        self::THEME_TOASTR,
    ];

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

        if (!in_array($this->theme, self::$_builtinThemes)) {
            throw new InvalidConfigException("Unknown theme: " . $this->theme, 501);
        }

    }
    /**
     * Renders the widget.
     */
    public function run()
    {
        switch($this->theme){
            case self::THEME_TOASTR:
                \lavrentiev\widgets\toastr\NotificationFlash::widget([
                    'options' => Json::decode($this->options)
                ]);
                break;
            case self::THEME_NOTY:
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
                        theme: '$this->theme',
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