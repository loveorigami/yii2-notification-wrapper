<?php

namespace lo\modules\noty\layers;

interface LayerInterface
{
    /*
     * Get js notification
     */
    public function getNotification($type, $message, $options);

    /*
     * Get type
     */
    public function getType($type);
}
