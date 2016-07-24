# Sweetalert
!["Sweetalert"](img/sweetalert.jpg)

Installation
--------

```bash
"loveorigami/yii2-notification-wrapper": "*",
"bower-asset/sweetalert": "^1.1"
# or "bower-asset/bootstrap-sweetalert": "^1.0"
```

to the ```require``` section of your `composer.json` file.


Usage
-----

```php
use lo\modules\noty\Wrapper;

echo Wrapper::widget([
    'layerClass' => 'lo\modules\noty\layers\Sweetalert',
    // or 'lo\modules\noty\layers\SweetalertBootstrap'
    'layerOptions' => [
        'theme' => 'facebook', // facebook, google, twitter
    ],
    // default options
    'options' => [
        'showCancelButton' => false,
        'closeOnConfirm' => false,
        'disableButtonsOnConfirm' => true,
        'html' => false
    ]
]);

```
