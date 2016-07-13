<?php

namespace lo\modules\noty\assets;

use yii\web\AssetBundle;

/**
 * Class GrowlAsset
 * @package lo\modules\noty\layers
 */
class GrowlAsset extends AssetBundle
{
    /** @var string  */
    public $sourcePath = '@bower/jquery-growl';

    /** @var array $css */
    public $css = [
        'stylesheets/jquery.growl.css'
    ];

    /** @var array $js */
    public $js = [
        'javascripts/jquery.growl.js'
    ];

    /** @var array $depends */
    public $depends = [
        'yii\web\JqueryAsset'
    ];
}
