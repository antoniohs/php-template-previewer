PHP Template Previewer 
======================
[![Build Status](https://api.shippable.com/projects/553f93e8edd7f2c052d5a0a9/badge?branchName=master)](https://app.shippable.com/projects/553f93e8edd7f2c052d5a0a9/builds/latest)

__PHP template previewer__ for designers testing their framework views without the working backend code.

Originally created for a personal project using the Phalcon PHP framework and its templating system Volt.

####Disclaimer:
This is my first composer as well as open source project, so if you see anything that needs improving, don't hesitate
and tell me.

##List of implemented frameworks
* Phalcon

###Extending the framework support
You can make a request for any framework that you want to use this library into, or even better, make a __pull request with your own framework strategy__.
Use the files under the _FrameworkStrategies_ folder as an example.


##Installation
###Composer
This library is available in packagist.org, you can add it to your project
via Composer.

In the "require" section of your composer.json file:

Always up to date (bleeding edge, API *not* guaranteed stable)
```javascript
"antonienko/php-template-previewer": "dev-master"
```

Specific minor version, API stability
```javascript
"antonienko/php-template-previewer": "0.1.*"
```

##Sample Usage on a Phalcon Controller used for design testing
You would call the url like this: `http://localhost/designTest/view/controllername/viewname` but you are not restricted to use it in this way

```php
namespace app\controllers;
use antonienko\PhpTempPrev\FrameworkStrategies\PhalconStrategy;
use antonienko\PhpTempPrev\Previewer;

class DesignTestController extends ControllerBase
{
    public function viewAction($controller, $view)
    {
        $view_variables_file = APP_PATH . 'templateHelpers/' . $controller . '/' . $view . '.ini';
        $layout_variables_file = APP_PATH . 'templateHelpers/general.ini';
        $previewer = new Previewer(new PhalconStrategy($this->view));
        $previewer->render("$controller/$view", [$layout_variables_file, $view_variables_file]);
    }
}
```

##License Information
Lincensed under __The MIT License (MIT)__. See the LICENSE file for more details.
