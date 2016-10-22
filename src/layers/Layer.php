<?php

namespace lo\modules\noty\layers;

use Yii;
use yii\base\Widget;

/**
 * Base Layer class
 */
class Layer extends Widget
{
    /**
     * @const type info
     */
    const TYPE_INFO = 'info';

    /**
     * @const type error
     */
    const TYPE_ERROR = 'error';

    /**
     * @const type success
     */
    const TYPE_SUCCESS = 'success';

    /**
     * @const type warning
     */
    const TYPE_WARNING = 'warning';

    /**
     * @const default layer-ID
     */
    const LAYER_ID = 'noty-layer';

    /**
     * @var string $layerId
     */
    public $layerId;

    /**
     * @var array $types
     */
    public $types = [self::TYPE_INFO, self::TYPE_ERROR, self::TYPE_SUCCESS, self::TYPE_WARNING];

    /**
     * @var bool $overrideSystemConfirm
     */
    public $overrideSystemConfirm = true;

    /**
     * @var bool $showTitle
     */
    public $showTitle = true;

    /**
     * @var string $customTitleDelimiter
     */
    public $customTitleDelimiter = '|';

    /**
     * @var array $defaultOptions
     */
    protected $defaultOptions = [];

    /**
     * @var string $type
     */
    protected $type;

    /**
     * @var string $title
     */
    protected $title;

    /**
     * @var string $message
     */
    protected $message;


    /**
     * init widget
     */
    public function init()
    {
        parent::init();

        $this->getLayerId();
    }

    /**
     * @return string
     */
    public function getLayerId()
    {
        return $this->layerId ? $this->layerId : self::LAYER_ID;
    }

    /**
     * @param $type
     */
    public function setType($type)
    {
        $this->type = (in_array($type, $this->types)) ? $type : self::TYPE_INFO;
    }

    /**
     * set title by type
     */
    public function setTitle()
    {
        switch ($this->type) {
            case self::TYPE_ERROR:
                $t = Yii::t('noty', 'Error');
                break;
            case self::TYPE_INFO:
                $t = Yii::t('noty', 'Info');
                break;
            case self::TYPE_WARNING:
                $t = Yii::t('noty', 'Warning');
                break;
            case self::TYPE_SUCCESS:
                $t = Yii::t('noty', 'Success');
                break;
            default:
                $t = '';
        }

        $this->title = $this->showTitle ? $t : '';
    }

    /**
     * @param $message
     */
    public function setMessage($message)
    {
        $msg = explode($this->customTitleDelimiter, $message);

        if (isset($msg[1])) {
            $this->message = trim($msg[1]);
            $this->title = trim($msg[0]);
        } else {
            $this->message = $message;
        }
    }

    /**
     * @return array
     */
    public function getDefaultOptions()
    {
        return $this->defaultOptions;
    }

    /**
     * @return string
     */
    public function getMessageWithTitle()
    {
        $msg = $this->showTitle ? '<b>' . $this->title . '</b><br>' . $this->message : $this->message;
        return $msg;
    }
}
