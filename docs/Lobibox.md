# Lobibox
!["Lobibox"](img/lobibox.jpg)

Installation
--------
```bash
"loveorigami/yii2-notification-wrapper": "*",
"bower-asset/lobibox": "*"
```

to the ```require``` section of your `composer.json` file.

Usage
-----
```php
use lo\modules\noty\Wrapper;

echo Wrapper::widget([
    'layerClass' => 'lo\modules\noty\layers\Lobibox',
    'layerOptions'=>[
        'soundPath' => false,
        'sound' => false
    ],
    // default options
    'options' => [
        'pauseDelayOnHover' => true,
        'continueDelayOnInactiveTab' => false,
        'delay' => 5000,
        'position' => 'top right',

        // and more for this library here https://github.com/arboshiki/lobibox 
    ],
]);

```
