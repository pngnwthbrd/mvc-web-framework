<?php

namespace Controllers\Factories;

use Core\AbstractFactory;
use Controllers\Interfaces\ControllerInterface;

class ControllerFactory extends AbstractFactory
{
    private const _NAMESPACE = '\\Controllers\\';

    public static function create($controller) : ControllerInterface
    {
        $controller_class =  self::_NAMESPACE . $controller;

        if (class_exists($controller_class))
            return new $controller_class();
        else
            trigger_error($controller . " is not a valid controller");

    }
}