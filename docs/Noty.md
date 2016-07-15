# Noty

Installation
--------

```bash
"loveorigami/yii2-notification-wrapper": "*",
"bower-asset/noty": "^2.3"
```

to the ```require``` section of your `composer.json` file.


Usage
-----

```php
use lo\modules\noty\Wrapper;

echo Wrapper::widget([
    'layerClass' => 'lo\modules\noty\layers\Noty',
    'layerOptions'=>[
        'registerAnimateCss' => false,
        'registerButtonsCss' => false
    ],
    // default options
    'options' => [
        'dismissQueue' => true,
        'layout' => 'topRight',
        'timeout' => 3000,
        'theme' => 'relax',

        // and more for this library...
    ],
]);

```
