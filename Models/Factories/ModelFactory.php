<?php

namespace Models\Factories;

use Core\AbstractFactory;
use Models\Interfaces\ModelInterface;

class ModelFactory extends AbstractFactory
{
        private const _NAMESPACE = '\\Models\\';
        
        public static function create($model) : ModelInterface
        {
                $model_class =  self::_NAMESPACE . $model;
                
                if (class_exists($model_class))
                        return new $model_class();
                else
                        trigger_error($model . " is not a valid model");

        }
}