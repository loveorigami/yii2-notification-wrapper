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
use lo\modules\noty\Wrapper;

echo Wrapper::widget([
    'layerClass' => 'lo\modules\noty\layers\Growl',
    // default options
    'options' => [
       'fixed' => true,
       'size' => 'medium',
       'location' => 'tr',
       'delayOnHover' => true,

        // and more for this library here https://github.com/ksylvest/jquery-growl
    ],
]);

```
