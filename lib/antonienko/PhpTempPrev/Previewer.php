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
use antonienko\PhpTempPrev\FrameworkStrategies\IFrameworkStrategy;

class Previewer
{
    protected $frameworkStrategy;
    public function __construct(IFrameworkStrategy $frameworkStrategy)
    {
        $this->frameworkStrategy = $frameworkStrategy;
    }

    public function render($viewName, $iniFile)
    {
        $vars = [];
        $ini_file_contents = parse_ini_file($iniFile, true);
        foreach ($ini_file_contents['scalars'] as $name => $value) {
            $vars[$name] =  $value;
        }
        foreach ($ini_file_contents['arrays'] as $name => $value) {
            $vars[$name] =  json_decode($value, true);
        }
        foreach ($ini_file_contents['objects'] as $name => $value) {
            $vars[$name] =  json_decode($value);
        }
        $this->frameworkStrategy->renderView($viewName, $vars);
    }
}