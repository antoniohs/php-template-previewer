<?php
/**
 * PHP Template Previewer
 *
 * @author Antonio Manuel Hernández Sánchez
 * @copyright Copyright (c) 2015 Antonio Manuel Hernández Sánchez
 * @license MIT
 * @link http://opensource.org/licenses/MIT
 */

namespace antonienko\PhpTempPrev;

use antonienko\PhpTempPrev\FileStrategies\IFileStrategy;
use antonienko\PhpTempPrev\FrameworkStrategies\IFrameworkStrategy;

class Previewer
{
    protected $frameworkStrategy;

    public function __construct(IFrameworkStrategy $frameworkStrategy)
    {
        $this->frameworkStrategy = $frameworkStrategy;
    }

    /**
     * @param mixed $viewName View name in a format that the strategy set in construction will understand
     * @param IFileStrategy $fileStrategy
     */
    public function render($viewName, IFileStrategy $fileStrategy = null)
    {
        if ($fileStrategy) {
            $vars = $fileStrategy->extractVars();
        } else {
            $vars = [];
        }
        $this->frameworkStrategy->renderView($viewName, $vars);
    }
}