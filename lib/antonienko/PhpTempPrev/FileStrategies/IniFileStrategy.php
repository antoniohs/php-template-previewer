<?php
/**
 * PHP Template Previewer
 *
 * @author Antonio Manuel Hernández Sánchez
 * @copyright Copyright (c) 2015 Antonio Manuel Hernández Sánchez
 * @license MIT
 * @link http://opensource.org/licenses/MIT
 */

namespace antonienko\PhpTempPrev\FileStrategies;

use antonienko\PhpTempPrev\Exceptions\InvalidFileException;

class IniFileStrategy extends BaseFileStrategy implements IFileStrategy
{
    public function extractVars()
    {
        $vars = [];
        foreach ($this->files as $ini_file) {
            if (!file_exists($ini_file)) {
                throw new InvalidFileException("File $ini_file doesn't exist");
            }
            $ini_file_contents = parse_ini_file($ini_file, true);
            if (isset($ini_file_contents['scalars'])) {

                foreach ($ini_file_contents['scalars'] as $name => $value) {
                    $vars[$name] = $value;
                }
            }
            if (isset($ini_file_contents['arrays'])) {
                foreach ($ini_file_contents['arrays'] as $name => $value) {
                    $vars[$name] = json_decode($value, true);
                }
            }
            if (isset($ini_file_contents['objects'])) {
                foreach ($ini_file_contents['objects'] as $name => $value) {
                    $vars[$name] = json_decode($value);
                }
            }
        }
        return $vars;
    }
}