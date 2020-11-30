<?php

namespace Services\Factories;

use Services\Interfaces\RouterInterface;

class RouterFactory
{
    private const _NAMESPACE = '\\Services\\';

    public static function create($service) : RouterInterface
    {
        $service_class =  self::_NAMESPACE . $service;

        if (class_exists($service_class))
            return new $service_class();
        else
            trigger_error($service . " is not a valid type");
    }
}