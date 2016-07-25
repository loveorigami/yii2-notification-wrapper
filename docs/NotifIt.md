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
use lo\modules\noty\Wrapper;

echo Wrapper::widget([
    'layerClass' => 'lo\modules\noty\layers\NotifIt',
    // default options
    'options' => [
        'multiline' => true,
        'position' => 'center',
        'width' => 'all',
        'clickable' => true,

        // and more for this library...
    ],
]);

```
