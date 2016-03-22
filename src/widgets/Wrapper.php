<?php
namespace lo\modules\noty\widgets;

use Yii;
use yii\base\InvalidConfigException;
use yii\helpers\Json;

/**
 * This package comes with a Wrapper widget that can be used to regularly poll the server for new notifications and trigger them visually using either Toastr, or Noty.
 *
 * This widget should be used in your main layout file as follows:
 *
 * ```php
 * use lo\modules\noty\widgets\Wrapper;
 *
 * Wrapper::widget([
 * 'theme' => Wrapper::THEME_TOASTR,
 * 'options' => [
 * 'closeButton' => false,
 * 'debug' => false,
 * 'newestOnTop' => true,
 *
 * // and more for this library
 *
 * "progressBar" => false,
 * "positionClass" => "toast-top-left",
 * "preventDuplicates" => false,
 * "onclick" => null,
 * "showDuration" => "300",
 * "hideDuration" => "1000",
 * "timeOut" => "5000",
 * "extendedTimeOut" => "1000",
 * "showEasing" => "swing",
 * "hideEasing" => "linear",
 * "showMethod" => "fadeIn",
 * "hideMethod" => "fadeOut"
 *
 * ],
 * ]);
 *
 * // or for THEME_NOTY
 * Wrapper::widget([
 * 'theme' => Wrapper::THEME_NOTY,
 * 'options' => [
 * 'dismissQueue' => true,
 * 'layout' => 'topRight',
 * 'timeout' => 3000,
 * //'theme' => 'relax',
 * ],
 * 'widgetOptions'=>[
 * 'enableSessionFlash' => true,
 * 'enableIcon' => true,
 * 'registerAnimateCss' => false,
 * 'registerButtonsCss' => false,
 * 'registerFontAwesomeCss' => false,
 * ]
 * ]);
 * ```
 */
class Wrapper extends \yii\base\Widget
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

    /** @var array $options */
    public $widgetOptions = [];

    /** @var string $types */
    public $types = ['info', 'error', 'success', 'warning'];

    /** @var string $typeDefault */
    public $typeDefault = 'info';


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
        switch ($this->theme) {
            case self::THEME_TOASTR:
                \lavrentiev\widgets\toastr\NotificationFlash::widget([
                    'options' => Json::decode($this->options)
                ]);
                break;
            case self::THEME_NOTY:
                $this->widgetOptions['options'] = Json::decode($this->options);
                \shifrin\noty\NotyWidget::widget($this->widgetOptions);
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

    /**
     * Ajax Callback.
     */
    public function ajaxCallback()
    {
        $session = \Yii::$app->session;
        $flashes = $session->getAllFlashes();
        $f = '';

        foreach ($flashes as $type => $data) {

            $data = (array)$data;
            $type = (in_array($type, $this->types)) ? $type : $this->typeDefault;

            switch ($this->theme) {
                case self::THEME_TOASTR:
                    foreach ($data as $i => $message) {
                        $f .= "toastr.{$type}('{$message}', '', {$this->options});";
                    }
                    break;

                case self::THEME_NOTY:
                    $f .= "var n = Noty('notyjs');";
                    foreach ($data as $i => $message) {
                        $f .= "
                            $.noty.setText(n.options.id, '$message');
                            $.noty.setType(n.options.id, '$type');
                        ";
                    }
                    break;
            }

            $session->removeFlash($type);
        }

        return '<script>' . $f . '</script>';
    }

}