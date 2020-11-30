<?php

namespace Core;

use Core\Interfaces\FactoryInterface;

abstract class AbstractFactory implements FactoryInterface
{
    abstract public static function create($class);
}