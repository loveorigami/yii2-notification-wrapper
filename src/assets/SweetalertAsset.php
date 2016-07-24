<?php

namespace lo\modules\noty\assets;

use yii\web\AssetBundle;

/**
 * Class SweetalertAsset
 * @package lo\modules\noty\layers
 */
class SweetalertAsset extends AssetBundle
{
    /** @var string  */
    public $sourcePath = '@bower/sweetalert';

    /** @var string  */
    public $theme;

    /** @var array  */
    public $themes = ['facebook', 'google', 'twitter'];

    /** @var array $css */
    public $css = [
        'dist/sweetalert.css'
    ];

    /** @var array $js */
    public $js = [
        'dist/sweetalert.min.js'
    ];

    /** @var array $depends */
    public $depends = [
        'yii\web\JqueryAsset'
    ];

    /**
     * @inheritdoc
     * Register css files as per the request
     * @param \yii\web\View $view
     */
    public function registerAssetFiles($view)
    {
        if ($this->theme && in_array($this->theme, $this->themes)) {
            $this->css[] = 'themes/'.$this->theme.'/'.$this->theme.'.css';
        }

        parent::registerAssetFiles($view);
    }
}
