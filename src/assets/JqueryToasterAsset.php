<?php

namespace lo\modules\noty\assets;

use yii\web\AssetBundle;

/**
 * Class JqueryToaster
 * @package lo\modules\noty\layers
 */
class JqueryToasterAsset extends AssetBundle
{
    /** @var string  */
    public $sourcePath = '@bower/jquery.toaster';

    /** @var array $js */
    public $js = [
        'jquery.toaster.js'
    ];

    /** @var array $depends */
    public $depends = [
        'yii\bootstrap\BootstrapPluginAsset'
    ];
}
