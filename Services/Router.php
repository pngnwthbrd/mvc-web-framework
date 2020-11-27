<?php

namespace Services;

use Services\Interfaces\RouterInterface;
use Controllers\Factories\ControllerFactory;

use \Exception;

class Router implements RouterInterface
{
        private $routes = array();

        public function add($route, $function = null,
                            $controller = null,
                            $action = null, $params = array())
        {
                $route = $this->_prepareRoute($route);

                $this->routes[$route] = [
                        'function' => $function,
                        'controller' => $controller,
                        'action' => $action,
                        'params' => $params
                ];
        }

        public function run($route, $request = array())
        {
                $route = $this->_prepareRoute($route);

                try
                {
                        $route = $this->get($route);
                        $func_params = $request;

                        if (is_null($route['params']) !== true)
                                $func_params = array_merge($func_params, $route['params']);

                        if (is_null($route['controller']) !== false) {
                                if (is_null($route['function']) !== true)
                                        return call_user_func($route['function']);
                                else
                                        return false;
                        } else {
                                if (is_null($route['action']) === true) {
                                        $controller = ControllerFactory::create($route['controller'], $func_params);
                                        return $controller->actionDefault($func_params);
                                } else {
                                        $controller = ControllerFactory::create($route['controller'], $func_params);
                                        return $class_object->{$route['action']}($func_params);
                                }
                        }
                }
                catch (Exception $error)
                {
                        throw new Exception('route or action unknown: ' . $error);
                }
        }

        public function get($route)
        {
                $key = ""; // route key
                $delim = "/";

                if (array_key_exists($route, $this->routes))
                        return $this->routes[$route];

                foreach ($this->routes as $name => &$current)
                {
                        $route_array = explode($delim, trim($route, $delim));
                        $name_array = explode($delim, trim($name, $delim));
                        $array_size = count($route_array);
                        if (count($route_array) === count($name_array)) {
                                for ($i = 0; $i < $array_size; $i++) {
                                        preg_match('/^\{(.*?)\}$/', $name_array[$i], $match);

                                        if (strcmp($route_array[$i], $name_array[$i]) === 0) {
                                                $key = ($i == 0) ? "" : $key;
                                                $key .= $route_array[$i] . $delim;
                                                continue;
                                        } else if (count($match) > 0) {
                                                $current['params'][$match[1]] = $route_array[$i];
                                                $key .= $match[0] . $delim;
                                                $yep = true;
                                                continue;
                                        } else {
                                                // do nothing...
                                                continue;
                                        }
                                }
                        }
                }

                $key = trim($key, $delim);

                return (array_key_exists($key, $this->routes)) ? $this->routes[$key] : false;
        }

        public function redirect($route, $response_code = 303, $replace = true)
        {
                header('Location: ' .  $route, $replace, $response_code);
        }

        private function _prepareRoute($route)
        {
                $strpos = strpos($route, '?');

                if ($strpos !== false)
                        $route = substr($route, 0, $strpos);

                $route = trim($route, '/');

                return $route;
        }
}