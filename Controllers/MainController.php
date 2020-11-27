<?php

namespace Controllers;

use Models\Factories\ModelFactory;
use Views\Factories\ViewFactory;

class MainController extends AbstractController
{
        private $model;
        private $view;
        
        public function __construct()
        {
                $this->model = ModelFactory::create('MainModel');
                $this->view = ViewFactory::create('MainView');
        }
        public function actionDefault()
        {
                $this->view->setTemplate('modules/main.tpl');
                $this->view->generateView();
                
                return $this->view->displayOutput();
        }
}