<?php

namespace Core\Interfaces;

interface FactoryInterface
{
    public static function create($class);
}