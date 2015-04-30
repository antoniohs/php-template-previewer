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

class BaseFileStrategy 
{
    protected $files;
    public function __construct(array $files)
    {
        $this->files = $files;
    }

}