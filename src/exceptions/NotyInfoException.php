<?php

namespace lo\modules\noty\exceptions;

use lo\modules\noty\layers\Layer;
use yii\base\Exception;

/**
 * Class NotyInfoException
 * @package lo\modules\noty\exceptions
 */
class NotyInfoException extends NotyFlashException
{
    /**
     * NotyInfoException constructor.
     * @param string $message
     * @param Exception|null $previous
     */
    public function __construct($message, Exception $previous = null)
    {
        $this->message = $message;
        parent::__construct(Layer::TYPE_INFO, $message, $previous);
    }
}
