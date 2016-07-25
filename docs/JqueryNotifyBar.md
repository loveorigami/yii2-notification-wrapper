# Jquery Notify Bar

Installation
--------

```bash
"loveorigami/yii2-notification-wrapper": "*",
"bower-asset/jqnotifybar": "^1.5"
```

to the ```require``` section of your `composer.json` file.


Usage
-----

```php
use lo\modules\noty\Wrapper;

echo Wrapper::widget([
    'layerClass' => 'lo\modules\noty\layers\JqueryNotifyBar'
    // default options
    'options' => [
        'position' => 'top',
        'delay' => 3000,
        'animationSpeed' => 'normal',

        // and more for this library herehttps://github.com/dknight/jQuery-Notify-bar
    ],
]);

```
