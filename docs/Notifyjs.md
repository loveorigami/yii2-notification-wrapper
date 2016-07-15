# Notify.js

Installation
--------

```bash
"loveorigami/yii2-notification-wrapper": "*",
"bower-asset/notifyjs": "^0.4"
```

to the ```require``` section of your `composer.json` file.


Usage
-----

```php
use lo\modules\noty\Wrapper;

echo Wrapper::widget([
    'layerClass' => 'lo\modules\noty\layers\Notifyjs',
    // default options
    'options' => [
           // whether to hide the notification on click
          'clickToHide' => true,

           // whether to auto-hide the notification
           'autoHide' => true,

           // if autoHide, hide after milliseconds
           'autoHideDelay' => 5000,

           // show the arrow pointing at the element
           'arrowShow' => true,

           // arrow size in pixels
           'arrowSize' => 5,

           // position defines the notification position though uses the defaults below
           'position' => '...',

           // default positions
           'elementPosition' => 'bottom left',
           'globalPosition' => 'top right',

           // default style
           'style' => 'bootstrap',

          // default class (string or [string])
           'className' => 'error',

           // show animation
           'showAnimation' => 'slideDown',

           // show animation duration
           'showDuration' => 400,

           // hide animation
           'hideAnimation' => 'slideUp',

           // hide animation duration
           'hideDuration' => 200,

           // padding between element and notification
           'gap' => 2

           // and more for this library https://notifyjs.com
    ],
]);

```
