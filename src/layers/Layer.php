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
     * @var array $types 
     */
    public $types = [self::TYPE_INFO, self::TYPE_ERROR, self::TYPE_SUCCESS, self::TYPE_WARNING];

    /** 
     * @var bool $overrideSystemConfirm 
     */
    public $overrideSystemConfirm = true;

    /** 
     * @var string $customTitleDelimiter 
     */
    public $customTitleDelimiter = '|';


    /**
     * @param $type
     * @return string
     */
    public function getType($type)
    {
        return (in_array($type, $this->types)) ? $type : self::TYPE_INFO;
    }

    /**
     * @param $type
     * @return string
     */
    public function getTitle($type)
    {
        switch ($type) {
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

        return $t;
    }
}
