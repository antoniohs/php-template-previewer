PHP Template Previewer 
======================
[![Build Status](https://api.shippable.com/projects/553f93e8edd7f2c052d5a0a9/badge?branchName=master)](https://app.shippable.com/projects/553f93e8edd7f2c052d5a0a9/builds/latest)

__PHP template previewer__ for designers testing their framework views without the working backend code.

Originally created for a personal project using the Phalcon PHP framework and its templating system Volt.

####Disclaimer:
This is my first composer as well as open source project, so if you see anything that needs improving, don't hesitate
and tell me. Read my [introduction post](http://www.antoniohs.com/2015/04/29/php-template-previewer-improving-the-workflow-between-web-designers-and-coders/)

##List of implemented frameworks
* Phalcon

###Extending the framework support
You can make a request for any framework that you want to use this library into, or even better, make a __pull request with your own framework strategy__.
Just implement the [IFrameworkStrategy interface](lib/antonienko/PhpTempPrev/FrameworkStrategies/IFrameworkStrategy.php). Use the files under the [FrameworkStrategies folder](lib/antonienko/PhpTempPrev/FrameworkStrategies) as an example.

##What's new
### v0.2.0
* Added Json file support for the variable files

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
"antonienko/php-template-previewer": "0.2.*"
```

If you have any problems with the _minimum-stability_ setting try appending @dev to the version
```javascript
"antonienko/php-template-previewer": "0.2.*@dev"
```


##Sample Usage
### Phalcon Framework
_DesignController_ with an action _View_ that gets two parameters: `$controller` and `$view`, which are the name of the controller and action view that you want to render.
You would call the url like this: `http://localhost/designTest/view/controllername/viewname` but you are not restricted to use it in this way

```php
namespace app\controllers;
use antonienko\PhpTempPrev\FrameworkStrategies\PhalconStrategy;
use antonienko\PhpTempPrev\FileStrategies\IniFileStrategy;
use antonienko\PhpTempPrev\Previewer;

class DesignTestController extends ControllerBase
{
    public function viewAction($controller, $view)
    {
        $view_variables_file = APP_PATH . 'templateHelpers/' . $controller . '/' . $view . '.ini';
        $layout_variables_file = APP_PATH . 'templateHelpers/general.ini';
        $previewer = new Previewer(new PhalconStrategy($this->view));
        $previewer->render("$controller/$view", new IniFileStrategy([$layout_variables_file, $view_variables_file]));
    }
}
```

### Var files
You pass to the render a class implementing `IFileStrategy` initialized with an array of _var files_. In case of having the same variable defined in two of the _var files_, the last one will prevail.

The variables are separated in three categories: _scalars_, _arrays_ and _objects_.

If you want to get an idea of how the _var files_ work [take a look at the test fixtures](tests/antonienko/tests/fixtures).

##License Information
Lincensed under __The MIT License (MIT)__. See the LICENSE file for more details.
