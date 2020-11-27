<?php

namespace Controllers;

use Controllers\Interfaces\ControllerInterface;

abstract class AbstractController implements ControllerInterface
{
        private $model;
        private $view;
        
        abstract public function __construct();
        
        abstract public function actionDefault();
}