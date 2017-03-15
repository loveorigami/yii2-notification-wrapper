<?php

namespace lo\modules\noty\assets;

use yii\web\AssetBundle;

/**
 * Class NotifItAsset
 * @package lo\modules\noty\layers
 */
class NotifItAsset extends AssetBundle
{
    /** @var string */
    public $sourcePath = '@bower/notifit/notifIt';

    /** @var array $css */
    public $css = [
        'css/notifIt.css',
    ];

    /** @var array $js */
    public $js = [
        'js/notifIt.min.js',
    ];

    /** @var array $depends */
    public $depends = [
        'yii\web\JqueryAsset'
    ];

    /**
     * @var array
     */
    public $publishOptions = [
        'only' => [
            "css/*",
            "js/*",
        ],
        'except' => [
            "dev"
        ],
    ];
}
