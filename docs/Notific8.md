# Notific8
!["Notific8"](img/notific8.jpg)

Installation
--------

```bash
"loveorigami/yii2-notification-wrapper": "*",
"bower-asset/notific8": "^3.5"
```

to the ```require``` section of your `composer.json` file.


Usage
-----

```php
use lo\modules\noty\Wrapper;

echo Wrapper::widget([
  'layerClass' => 'lo\modules\noty\layers\Notific8',
  // default options
  'options' => [
        'life' => 5000,
        'sticky' => false,
        'horizontalEdge' => 'top',
        'verticalEdge' => 'right',
        'family' => 'legacy', // legacy, chicchat, atomic

        // and more for this library https://github.com/ralivue/notific8/wiki/Options
  ],
]);

```
