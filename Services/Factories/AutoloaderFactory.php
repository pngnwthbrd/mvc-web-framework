<?php

namespace Services\Factories;

require __DIR__ . '/../Autoloader.php';

use Services\Interfaces\AutoloaderInterface;

class AutoloaderFactory
{
    private const _NAMESPACE = '\\Services\\';

    public static function create($service) : AutoloaderInterface
    {
        $service_class =  self::_NAMESPACE . $service;

        if (class_exists($service_class))
            return new $service_class();
        else
            trigger_error($service . " is not a valid type");
    }
}