# iGrowl

Important - this layer is not stable, because have conflict with bootstrap

Installation
--------

```bash
"loveorigami/yii2-notification-wrapper": "*",
"bower-asset/igrowl": "*"
```

to the ```require``` section of your `composer.json` file.


Usage
-----

```php
use lo\modules\noty\Wrapper;

echo Wrapper::widget([
    'layerClass' => 'lo\modules\noty\layers\Igrowl',
    // default options
    'options' => [
        'placement' => [
            'x'=>'right',
            'y'=>'top',
        ],
        'animation' => true,
        'delay' => 3000,

        // and more for this library here https://github.com/catc/iGrowl
    ],
]);

```
