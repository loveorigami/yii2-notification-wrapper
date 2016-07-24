<?php

namespace lo\modules\noty\assets;

use yii\web\AssetBundle;

/**
 * Class SweetalertBootstrapAsset
 * @package lo\modules\noty\layers
 */
class SweetalertBootstrapAsset extends AssetBundle
{
    /** @var string  */
    public $sourcePath = '@bower/bootstrap-sweetalert/dist';

    /** @var array $css */
    public $css = [
        'sweetalert.css'
    ];

    /** @var array $js */
    public $js = [
        'sweetalert.min.js'
    ];

    /** @var array $depends */
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}
