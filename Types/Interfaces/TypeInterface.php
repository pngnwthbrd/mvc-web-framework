<?php

namespace Types\Interfaces;

interface TypeInterface
{
        /**
         * @param string $prop
         * @param mixed $value
         */
        public function setProperty($prop, $value) : void;
        
        /**
         * @param string $prop
         */
        public function getProperty($prop);
        
        /**
         * @return array
         */
        public function getProperties() : array;
}