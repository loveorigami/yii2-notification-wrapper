<?php

namespace lo\modules\noty\layers;

use lo\modules\noty\assets\SweetalertBootstrapAsset;

/**
 * Class SweetalertBootsrap
 * @package lo\modules\noty\layers
 *
 * This widget should be used in your main layout file as follows:
 * ```php
 *  use lo\modules\noty\Wrapper;
 *
 *  echo Wrapper::widget([
 *      'layerClass' => 'lo\modules\noty\layers\SweetalertBootsrap',
 *      'options' => [
 *          'showCancelButton' => false,
 *          'closeOnConfirm' => false,
 *          'disableButtonsOnConfirm' => true,
 *          'html' => false
 *
 *          // and more for this library...
 *      ],
 *  ]);
 * ```
 */
class SweetalertBootstrap extends Sweetalert implements LayerInterface
{
    /**
     * Register required assets
     */
    public function registerAssets()
    {
        $view = $this->getView();
        SweetalertBootstrapAsset::register($view);
    }

}
