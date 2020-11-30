<?php

namespace Services;

require 'Interfaces/AutoloaderInterface.php';

use Services\Interfaces\AutoloaderInterface;

class Autoloader implements AutoloaderInterface
{
    public function register() : void
    {
        spl_autoload_register(
            function($class)
            {
                $class_path = __DIR__ . '/../'
                . str_replace('\\',
                DIRECTORY_SEPARATOR, $class)
                . '.php';
                if (file_exists($class_path))
                    require $class_path;
                else
                    trigger_error('class path not found.' . $class_path);
            }
        );
    }
}