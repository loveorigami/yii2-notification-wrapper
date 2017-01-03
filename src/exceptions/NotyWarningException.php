<?php

namespace lo\modules\noty\exceptions;

use lo\modules\noty\layers\Layer;
use yii\base\Exception;

/**
 * Class NotyWarningException
 * @package lo\modules\noty\exceptions
 */
class NotyWarningException extends NotyFlashException
{
    /**
     * NotyWarningException constructor.
     * @param string $message
     * @param Exception|null $previous
     */
    public function __construct($message, Exception $previous = null)
    {
        $this->message = $message;
        parent::__construct(Layer::TYPE_WARNING, $message, $previous);
    }
}
