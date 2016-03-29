<?php

namespace lo\modules\noty\widgets\layers;

use yii\web\AssetBundle;

/**
 * Class NotyAsset
 * @package lo\modules\noty\widgets\layers
 */
class NotifyjsAsset extends AssetBundle
{
    public $sourcePath = '@bower/noty';
    public $style;

    public $js = [
        'js/noty/packaged/jquery.noty.packaged.min.js'
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];

    /**
     * @inheritdoc
     * Register css files as per the request
     * @param \yii\web\View $view
     */
    public function registerAssetFiles($view)
    {
        if ($this->animateCss) {
            $this->css[] = 'demo/animate.css';
        }

        parent::registerAssetFiles($view);
    }

}