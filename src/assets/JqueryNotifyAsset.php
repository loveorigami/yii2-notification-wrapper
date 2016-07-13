<?php

namespace lo\modules\noty\assets;

use yii\web\AssetBundle;

/**
 * Class JqueryNotifyAsset
 * @package lo\modules\noty\layers
 */
class JqueryNotifyAsset extends AssetBundle
{
    /** @var string  */
    public $sourcePath = '@bower/jquery.notify';

    /** @var array $css */
    public $css = [
        'css/jquery.notify.css'
    ];

    /** @var array $js */
    public $js = [
        'js/jquery.notify.min.js'
    ];

    /** @var array $depends */
    public $depends = [
        'yii\web\JqueryAsset'
    ];
}
