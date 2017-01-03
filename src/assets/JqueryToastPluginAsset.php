<?php

namespace lo\modules\noty\assets;

use yii\web\AssetBundle;

/**
 * Class JqueryToastPlugin
 * @package lo\modules\noty\layers
 */
class JqueryToastPluginAsset extends AssetBundle
{
    /** @var string  */
    public $sourcePath = '@bower/jquery-toast-plugin/dist';

    /** @var array $css */
    public $css = [
        'jquery.toast.min.css'
    ];

    /** @var array $js */
    public $js = [
        'jquery.toast.min.js'
    ];

    /** @var array $depends */
    public $depends = [
        'yii\web\JqueryAsset'
    ];
}
