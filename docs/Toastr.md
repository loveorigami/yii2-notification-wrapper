# Toastr

Installation
--------

```bash
"loveorigami/yii2-notification-wrapper": "*",
"bower-asset/toastr": "^2.1"
```

to the ```require``` section of your `composer.json` file.


Usage
-----

```php
use lo\modules\noty\Wrapper;

echo Wrapper::widget([
    'layerClass' => 'lo\modules\noty\layers\Toastr',
    // default options
    'options' => [
       'closeButton' => false,
       'debug' => false,
       'newestOnTop' => true,

        // and more for this library...
    ],
]);

```
