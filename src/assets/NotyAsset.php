<?php

namespace lo\modules\noty\assets;

use yii\web\AssetBundle;

/**
 * Class NotyAsset
 * @package lo\modules\noty\layers
 */
class NotyAsset extends AssetBundle
{
    public $sourcePath = '@bower/noty';
    public $animateCss;
    public $buttonsCss;

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

        if ($this->buttonsCss) {
            $this->css[] = 'demo/buttons.css';
        }

        parent::registerAssetFiles($view);
    }
}
