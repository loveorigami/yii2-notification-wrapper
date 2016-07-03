<?php

namespace lo\modules\noty\widgets\layers;

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
