# Growl

Installation
--------

```bash
"loveorigami/yii2-notification-wrapper": "*",
"bower-asset/jquery-growl": "*"
```

to the ```require``` section of your `composer.json` file.


Usage
-----

```php
use lo\modules\noty\widgets\Wrapper;

echo Wrapper::widget([
    'layerClass' => 'lo\modules\noty\widgets\layers\Growl',
    'options' => [
       'fixed' => true,
       'size' => 'medium',
       'style' => 'default',
       'location' => 'tr',
       'delayOnHover' => true,

        // and more for this library here https://github.com/ksylvest/jquery-growl
    ],
]);

```
