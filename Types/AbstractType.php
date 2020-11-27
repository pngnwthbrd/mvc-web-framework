<?php

namespace Types;

use Types\Interfaces\TypeInterface;

abstract class AbstractType implements TypeInterface
{
        public function setProperty($prop, $value) : void
        {
                if (property_exists($this, $prop))
                        $this->$prop = $value;
        }

        public function getProperty($prop)
        {
                return $this->$prop;
        }

        public function getProperties() : array
        {
                return get_object_vars($this);
        }
}