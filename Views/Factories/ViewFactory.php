<?php

namespace Views\Factories;

use Core\AbstractFactory;
use Views\Interfaces\ViewInterface;

class ViewFactory extends AbstractFactory
{
    private const _NAMESPACE = '\\Views\\';

    public static function create($view) : ViewInterface
    {
        $view_class =  self::_NAMESPACE . $view;

        if (class_exists($view_class))
            return new $view_class();
        else
            trigger_error($view . " is not a valid view");

    }
}