<?php

namespace Services\Interfaces;

interface ErrorHandlerInterface
{
        public function shutdown() : void;
        
        /**
         * @param int const $type
         * @param string $message
         * @param string $file
         * @param int $line
         */
        public function handleError($type, $message, $file, $line) : void;
}