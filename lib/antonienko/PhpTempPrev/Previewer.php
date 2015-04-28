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

use antonienko\PhpTempPrev\Exceptions\InvalidIniFileException;
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
     * @param string|array $iniFile Path and filename of the ini file(s) that values should be loaded from
     */
    public function render($viewName, $iniFile = array())
    {
        $vars = [];
        $ini_files = is_array($iniFile) ? $iniFile : array($iniFile);

        foreach ($ini_files as $ini_file) {
            if(!file_exists($ini_file)) {
                throw new InvalidIniFileException("File $ini_file doesn't exist");
            }
            $ini_file_contents = parse_ini_file($ini_file, true);
            foreach ($ini_file_contents['scalars'] as $name => $value) {
                $vars[$name] = $value;
            }
            foreach ($ini_file_contents['arrays'] as $name => $value) {
                $vars[$name] = json_decode($value, true);
            }
            foreach ($ini_file_contents['objects'] as $name => $value) {
                $vars[$name] = json_decode($value);
            }
        }
        $this->frameworkStrategy->renderView($viewName, $vars);
    }
}