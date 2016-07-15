# JqueryNotify
!["Jquery Notify"](img/jnotify.jpg)

Installation
--------

```bash
"loveorigami/yii2-notification-wrapper": "*",
"bower-asset/jquery.notify": "^1.0"
```

to the ```require``` section of your `composer.json` file.


Usage
-----

```php
use lo\modules\noty\Wrapper;

echo Wrapper::widget([
         'layerClass' => 'lo\modules\noty\layers\JqueryNotify',
         // default options
         'options' => [
             'theme' => 'default', // or 'dark-theme'
             'position' =>[
                 'x' => 'right',
                 'y' => 'top'
             ],
             'overlay' => false,
             'overflowHide' => false,
             'autoHide' => true,

        // and more for this library here https://github.com/CreativeDream/jquery.notify
    ],
]);

```
