# Bootstrap Notify
!["Bootstrap Notify"](img/bootstrap-notify.jpg)

Installation
--------

```bash
"loveorigami/yii2-notification-wrapper": "*",
"bower-asset/remarkable-bootstrap-notify": "^3.1",
```

to the ```require``` section of your `composer.json` file.


Usage
-----

```php
use lo\modules\noty\Wrapper;

echo Wrapper::widget([
    'layerClass' => 'lo\modules\noty\layers\BootstrapNotify',
    // default options
    'options' => [
        'newest_on_top' => false,
        'showProgressbar' => true,
        'placement' => [
            'from' => 'top',
            'align' => 'right'
        ]

        // and more for this library here https://github.com/mouse0270/bootstrap-notify
    ],
]);

```
