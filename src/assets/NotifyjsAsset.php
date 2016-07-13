<?php

namespace lo\modules\noty\assets;

use yii\web\AssetBundle;

/**
 * Class NotyAsset
 * @package lo\modules\noty\layers
 */
class NotifyjsAsset extends AssetBundle
{
    public $sourcePath = '@bower/notifyjs/dist';

    public $js = [
        'notify.js'
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
        parent::registerAssetFiles($view);
    }
}
