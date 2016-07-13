<?php

namespace lo\modules\noty\assets;

use yii\web\AssetBundle;

/**
 * Class NotieAsset
 * @package lo\modules\noty\layers
 */
class NotieAsset extends AssetBundle
{
    /** @var string  */
    public $sourcePath = '@bower/notie/dist';

    /** @var array $css */
    public $css = [
        'notie.css'
    ];

    /** @var array $js */
    public $js = [
        'notie.min.js'
    ];

    /** @var array $depends */
    public $depends = [
        'yii\web\JqueryAsset'
    ];
}
