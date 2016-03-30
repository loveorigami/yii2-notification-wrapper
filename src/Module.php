<?php

namespace lo\modules\noty;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'lo\modules\noty\controllers';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
		// initialize the module with the configuration loaded from config.php
        //\Yii::configure($this, require(__DIR__ . '/config.php'));

        if (!isset(\Yii::$app->i18n->translations['noty'])) {
            \Yii::$app->i18n->translations['noty'] = [
                'class' => 'yii\i18n\PhpMessageSource',
                'sourceLanguage' => 'en',
                'basePath' => __DIR__ . '/messages',
            ];
        }
    }
}