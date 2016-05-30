<?php

namespace lo\modules\noty;

use yii\base\BootstrapInterface;

/**
 * noty module bootstrap class.
 */
class Bootstrap implements BootstrapInterface
{
    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {
        // add module I18N category
        if (!isset($app->i18n->translations['noty'])) {
            $app->i18n->translations['noty'] = [
                'class' => 'yii\i18n\PhpMessageSource',
                'sourceLanguage' => 'en-US',
                'basePath' => '@lo/modules/noty/messages',
            ];
        }
    }
}
