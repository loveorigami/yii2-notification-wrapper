<?php

namespace lo\modules\noty\layers;

/**
 * Interface LayerInterface
 * @package lo\modules\noty\layers
 */
interface LayerInterface
{
    /**
     * Get default client options for current layer
     * @return array
     */
    public function getDefaultOptions();

    /**
     * Get js notification
     * @param $options
     * @return mixed
     */
    public function getNotification($options);

    /**
     * @param $type
     * @return string
     */
    public function setType($type);

    /**
     * @return string
     */
    public function setTitle();

    /**
     * @param $message
     * @return string
     */
    public function setMessage($message);
}
