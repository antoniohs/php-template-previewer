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

class JsonFileStrategy extends BaseFileStrategy implements IFileStrategy
{
    public function extractVars()
    {
        $vars = [];
        foreach ($this->files as $json_file) {
            if (!file_exists($json_file)) {
                throw new InvalidFileException("File $json_file doesn't exist");
            }
            $json_contents = file_get_contents($json_file);
            $decoded_json = json_decode($json_contents, true);
            if (isset($decoded_json['scalars'])) {
                foreach ($decoded_json['scalars'] as $name => $value) {
                    $vars[$name] = $value;
                }
            }
            if (isset($decoded_json['arrays'])) {
                foreach ($decoded_json['arrays'] as $name => $value) {
                    $vars[$name] = $value;
                }
            }
            if (isset($decoded_json['objects'])) {
                foreach ($decoded_json['objects'] as $name => $value) {
                    $vars[$name] = (object) $value;
                }
            }
        }
        return $vars;
    }
}