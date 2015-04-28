<?php
/**
 * PHP Template Previewer
 *
 * @author Antonio Manuel Hernández Sánchez
 * @copyright Copyright (c) 2015 Antonio Manuel Hernández Sánchez
 * @license MIT
 * @link http://opensource.org/licenses/MIT
 */

namespace antonienko\PhpTempPrev\FrameworkStrategies;

use Phalcon\Mvc\View;

class PhalconStrategy implements IFrameworkStrategy
{
    protected $view;

    public function __construct(View $view)
    {
        $this->view = $view;
    }

    public function renderView ($viewName, array $vars)
    {
        foreach($vars as $name => $value) {
            $this->view->setVar($name, $value);
        }
        $this->view->pick($viewName);
    }
}