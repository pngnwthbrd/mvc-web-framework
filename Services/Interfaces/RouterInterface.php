<?php

namespace Services\Interfaces;

interface RouterInterface
{
        /**
         * @param string $route
         * @param string $function
         * @param string $controller
         * @param string $action
         * @param array $params
         */
        public function add($route, $function, $controller,
                            $action, $params);

        /**
         * @param string $route
         * @param array $request
         */
        public function run($route, $request);
        
        /**
         * @param string $route
         */
        public function get($route);
        
        /**
         * @param string $route
         * @param integer $response_code
         * @param boolean $replace
         */
        public function redirect($route, $response_code, $replace);
}