<?php

namespace lo\modules\noty\assets;

use yii\web\AssetBundle;

/**
 * Class Notific8Asset
 * @package lo\modules\noty\layers
 */
class Notific8Asset extends AssetBundle
{
    /** @var string  */
    public $sourcePath = '@bower/notific8/dist';

    /** @var array $css */
    public $css = [
        'jquery.notific8.min.css',
        'modules/icon/notific8-icon.min.css',
        'modules/image/notific8-image.min.css',
    ];

    /** @var array $js */
    public $js = [
        'notific8.min.js',
        'jquery.notific8.min.js',
        'modules/icon/notific8-icon.min.js',
        'modules/image/notific8-image.min.js',
    ];

    /** @var array $depends */
    public $depends = [
        'yii\web\JqueryAsset'
    ];
}
