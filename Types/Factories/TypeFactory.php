<?php

namespace Types\Factories;

use Core\AbstractFactory;
use Types\Interfaces\TypeInterface;

class TypeFactory extends AbstractFactory
{
        private const _NAMESPACE = '\\Types\\';
        
        public static function create($type) : TypeInterface
        {
                $type_class =  self::_NAMESPACE . $type;
                
                if (class_exists($type_class))
                        return new $type_class();
                else
                        trigger_error($type . " is not a valid type");

        }
}