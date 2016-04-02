# NotifIt
!["NotifIt"](img/notifit.jpg)

Installation
--------

```bash
"loveorigami/yii2-notification-wrapper": "*",
"bower-asset/notifit": "^1.1"
```

to the ```require``` section of your `composer.json` file.


Usage
-----

```php
use lo\modules\noty\widgets\Wrapper;

echo Wrapper::widget([
         'layerClass' => 'lo\modules\noty\widgets\layers\PNotify',
         'options' => [
            'multiline' => true,
            'position' => 'right',
            'append' => true,
            'clickable' => true,

              // and more for this library here https://github.com/naoxink/notifIt

         ],
     ]);

```
