<?php

namespace lo\modules\noty\widgets\layers;

interface LayerInterface
{
    /*
     * If not used - return false
     */
    public function run();

    /*
     * Get js notification
     */
    public function getNotification($type, $message, $options);
}
