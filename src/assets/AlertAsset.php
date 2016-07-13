<?php

namespace lo\modules\noty\assets;

use yii\web\AssetBundle;

/**
 * Class AlertAsset
 * @package lo\modules\noty\layers
 */
class AlertAsset extends AssetBundle
{
    /** @var array $depends */
    public $depends = [
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
