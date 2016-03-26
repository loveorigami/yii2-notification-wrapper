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

Wrapper::widget([
    'layerClass' => 'lo\modules\noty\widgets\layers\Growl',
    'options' => [
       'closeButton' => false,
       'debug' => false,
       'newestOnTop' => true,

        // and more for this library...
    ],
]);

```
