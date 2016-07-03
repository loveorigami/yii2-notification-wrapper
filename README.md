# Yii2-notification-wrapper

Yii2-notification-wrapper module renders a message from session flash (with ajax support). All flash messages are displayed in the sequence they were assigned using setFlash.

!["Demo"](docs/img/noty-demo.jpg)

You can set message as following:

 ```php
public function actionIndex(){
    ...
     \Yii::$app->getSession()->setFlash('error',   'noty error');
     \Yii::$app->getSession()->setFlash('info',    'noty info');
     \Yii::$app->getSession()->setFlash('success', 'noty success');
     \Yii::$app->getSession()->setFlash('warning', 'noty warning');
    ...
     return $this->render('index');
 }

 // or in ajax action

 public function actionAjax(){
     ...
     \Yii::$app->getSession()->setFlash('error',   'ajax error');
     \Yii::$app->getSession()->setFlash('info',    'ajax info');
     \Yii::$app->getSession()->setFlash('success', 'ajax success');
     \Yii::$app->getSession()->setFlash('warning', 'ajax warning');
     ...
     $data = 'Some data to be returned in response to ajax request';
     Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
     return $data;
  }
 ```

Installation
--------
The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

To install with bower package for one of supported layers, either run

```bash
$ php composer.phar require loveorigami/yii2-notification-wrapper "*"
$ php composer.phar require bower-asset/noty "^2.3"
```

or add

```bash
"loveorigami/yii2-notification-wrapper": "*",
"bower-asset/noty": "^2.3"
```

to the ```require``` section of your `composer.json` file.


Configure application
---------------------

Let's start with defining module in our config file (`@common/config/main.php`):

```php
'modules' => [
    'noty' => [
        'class' => 'lo\modules\noty\Module',
    ],
],
```
That's all, now you have module installed and configured.

Usage
-----

This package comes with a Wrapper widget that can be used to regularly poll the server for new notifications and trigger them visually using either Noty (or Toastr, or Growl etc.).

This widget should be used in your main layout file as follows:

```php
use lo\modules\noty\widgets\Wrapper;

echo Wrapper::widget([
    'layerClass' => 'lo\modules\noty\widgets\layers\Noty',
    'layerOptions'=>[
        // for every layer (by default)
        'customTitleDelimiter' => '|',
        'overrideSystemConfirm' => true,

        // for custom layer
        'registerAnimateCss' => true,
        'registerButtonsCss' => true
    ],
    'overrideSystemConfirm' => true,

    // clientOptions
    'options' => [
        'dismissQueue' => true,
        'layout' => 'topRight',
        'timeout' => 3000,
        'theme' => 'relax',

        // and more for this library...
    ],
]);

```

Some libraries can override System Confirm for links as:

```html
<a href="https://github.com" data-confirm="Are you sure?">Go!</a>
```

Custom title (example for Growl) 
----------------
If you want change notification title, you can use ```customTitleDelimiter``` in our messages
```php
    Wrapper::widget([
        'layerClass' => 'lo\modules\noty\widgets\layers\Growl',
        'layerOptions' => [
            'customTitleDelimiter' = '|', // by default
        ],
        'options' => [   
            // and more for this library here https://github.com/ksylvest/jquery-growl
        ],
    ]);
```
and set message in action as
```php
public function actionIndex(){
    ...
     \Yii::$app->getSession()->setFlash('success', 'CUSTOM TITLE | noty success');
    ...
 }
```
!["Custom Title"](docs/img/custom_title.png)

Supported layers
----------------

Currently supported layers are:

| Library (Layer) | Bower         | Confirm | Project homepage                                 | Docs                          |
| --------------- | ------------- | ------- | ------------------------------------------------ | ----------------------------- |
| Bootstrap Alert | -             |    -    | http://getbootstrap.com/components/#alerts       | [read](docs/Alert.md)         |
| Growl           | jquery-growl  |    -    | https://github.com/ksylvest/jquery-growl         | [read](docs/Growl.md)         |
| Jquery Notify   | jquery.notify |    -    | https://github.com/CreativeDream/jquery.notify   | [read](docs/JqueryNotify.md)  |
| Notie           | notie         |    +    | https://github.com/jaredreich/notie              | [read](docs/Notie.md)         |
| NotifIt         | notifit       |    +    | https://github.com/naoxink/notifIt               | [read](docs/NotifIt.md)       |
| Notify.js       | notifyjs      |    -    | https://github.com/notifyjs/notifyjs             | [read](docs/Notifyjs.md)      |
| Noty            | noty          |    +    | https://github.com/needim/noty                   | [read](docs/Noty.md)          |
| PNotify         | pnotify       |    +    | https://github.com/sciactive/pnotify             | [read](docs/PNotify.md)       |
| Toastr          | toastr        |    -    | https://github.com/CodeSeven/toastr              | [read](docs/Toastr.md)        |


Full installation
--------

Add

```bash
"loveorigami/yii2-notification-wrapper": "*",
"bower-asset/noty": "^2.3",
"bower-asset/jquery-growl": "^1.3",
"bower-asset/jquery.notify": "^1.0",
"bower-asset/notie": "^3.2",
"bower-asset/notifit": "^1.1",
"bower-asset/notifyjs": "^0.4",
"bower-asset/pnotify": "^3.0",
"bower-asset/toastr": "^2.1",
```

to the ```require``` section of your `composer.json` file.

License
-------

Yii2-notification-wrapper is released under the MIT License. See the bundled [LICENSE.md](LICENSE.md)
for details.
