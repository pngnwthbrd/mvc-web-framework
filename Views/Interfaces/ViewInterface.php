<?php

namespace Views\Interfaces;

interface ViewInterface
{
    /**
     * @param boolean $caching
     */
    public function setCaching(bool $caching) : void;
    
    /**
     * @param string $tpl
     * @return Smarty fetched template
     */
    public function fetchTemplate($tpl);
    /**
     * @param string key
     * @param mixed $value
     */
    public function assign($key, $value) : void;
    
    /**
     * @param string $base_tpl
     */
    public function displayOutput($base_tpl = 'index.tpl') : void;
    
    /**
     * @param string $type
     * @param string $file
     */
    public function asset($type, $file) : void;
    
    /**
     * @param array|object $module_data
     * @param bool $walk
     */
    public function prepareData($module_data, $walk) : void;
    
    /**
     * @param string $template_file
     */
    public function setTemplate($template_file) : void;
    
    public function generateView() : void;
    
    public function generateAjaxView();
}