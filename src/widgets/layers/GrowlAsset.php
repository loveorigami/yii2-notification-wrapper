<?php

namespace lo\modules\noty\widgets\layers;

use yii\web\AssetBundle;

/**
 * Class GrowlAsset
 * @package lo\modules\noty\widgets\layers
 */
class GrowlAsset extends AssetBundle
{
    /** @var string  */
    public $sourcePath = '@bower/toastr';

    /** @var array $css */
    public $css = [
        'toastr.min.css'
    ];

    /** @var array $js */
    public $js = [
        'toastr.min.js'
    ];

    /** @var array $depends */
    public $depends = [
        'yii\web\JqueryAsset'
    ];
}