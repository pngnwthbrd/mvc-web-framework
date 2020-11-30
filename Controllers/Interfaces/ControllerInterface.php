<?php

namespace Controllers\Interfaces;

interface ControllerInterface
{
    /**
     * use contructor to initialisize
     * model and view
     */
    public function __construct();
    
    public function actionDefault();
}