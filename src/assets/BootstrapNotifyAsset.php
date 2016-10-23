<?php

namespace lo\modules\noty\assets;

use yii\web\AssetBundle;

/**
 * Class BootstrapNotifyAsset
 * @package lo\modules\noty\layers
 */
class BootstrapNotifyAsset extends AssetBundle
{
    /** @var string  */
    public $sourcePath = '@bower/remarkable-bootstrap-notify';

    /** @var array $js */
    public $js = [
        'bootstrap-notify.min.js'
    ];

    /** @var array $depends */
    public $depends = [
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
