<?php

namespace lo\modules\noty\assets;

use yii\web\AssetBundle;

/**
 * Class PNotifyAsset
 * @package lo\modules\noty\layers
 */
class PNotifyAsset extends AssetBundle
{
    /** @var string  */
    public $sourcePath = '@bower/pnotify/dist';

    /** @var array $css */
    public $css = [
        'pnotify.css',
        'pnotify.brighttheme.css',
        'pnotify.buttons.css',
        'pnotify.history.css',
        'pnotify.mobile.css',
    ];

    /** @var array $js */
    public $js = [
        'pnotify.js',
        'pnotify.animate.js',
        'pnotify.buttons.js',
        'pnotify.confirm.js',
        'pnotify.desktop.js',
        'pnotify.history.js',
        'pnotify.mobile.js',
        'pnotify.nonblock.js',
    ];

    /** @var array $depends */
    public $depends = [
        'yii\web\JqueryAsset'
    ];
}
