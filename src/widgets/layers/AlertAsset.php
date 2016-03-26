<?php

namespace lo\modules\noty\widgets\layers;

use yii\web\AssetBundle;

/**
 * Class AlertAsset
 * @package lo\modules\noty\widgets\layers
 */
class AlertAsset extends AssetBundle
{
    /** @var array $depends */
    public $depends = [
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}