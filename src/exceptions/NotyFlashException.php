<?php

namespace lo\modules\noty\exceptions;

use Yii;
use yii\base\Exception;

/**
 * Class NotyFlashException
 * @package lo\modules\noty\exceptions
 */
class NotyFlashException extends Exception
{
    /**
     * @var string
     */
    private $type;

    /**
     * NotyFlashException constructor.
     * @param string $type
     * @param int $message
     * @param Exception|null $previous
     */
    public function __construct($type, $message, Exception $previous = null)
    {
        $this->type = $type;
        $this->message = $message;
        parent::__construct($message, 0, $previous);
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * add to session
     */
    public function catchFlash()
    {
        Yii::$app->session->setFlash($this->getType(), $this->getMessage());
    }
}
