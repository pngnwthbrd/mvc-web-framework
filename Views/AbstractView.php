<?php

namespace Views;

use Views\Interfaces\ViewInterface;
use \Smarty;

abstract class AbstractView implements ViewInterface
{
    private $smarty;
    protected $assets = array(
        'styles' => array(),
        'scripts' => array()
    );

    protected $template;

    public function __construct()
    {
        $this->_initSmarty();
        $this->setCaching(false);

        $this->asset('styles', 'css/bootstrap/bootstrap.min.css');
        $this->asset('styles', 'css/fontawesome/fontawesome.min.css');
        $this->asset('styles', 'css/fontawesome/all.min.css');
        $this->asset('styles', 'css/app.css');
        $this->asset('scripts', 'js/libs/jquery.min.js');
        $this->asset('scripts', 'js/bootstrap/bootstrap.min.js');
        $this->asset('scripts', 'js/fontawesome/fontawesome.min.js');
        $this->asset('scripts', 'js/fontawesome/all.min.js');
    }


    public function fetchTemplate($tpl)
    {
        return $this->smarty->fetch($tpl);
    }

    public function assign($key, $value) : void
    {
        $this->smarty->assign($key, $value);
    }

    public function displayOutput($base_tpl = 'index.html') : void
    {
        $this->_prepareOutput();
        $this->smarty->display($base_tpl);
    }

    public function asset($type, $file) : void
    {
        if ($this->_validateAsset($type)) {
            $this->assets[$type][] = 'assets'
            . DIRECTORY_SEPARATOR
            . $file;
        }
    }

    public function prepareData($module_data, $walk = false) : void
    {
        if ((bool) $walk === true)
            foreach ($module_data as $key => $value)
                $this->asset($key, $value);
        else
            $this->asset('module_data', $module_data);
    }

    public function generateView() : void
    {
        $view = $this->fetchTemplate($this->template);
        $this->assign('module_content', $view);
    }

    public function generateAjaxView()
    {
        $view = $this->fetchTemplate($this->template);
        return $view;
    }

    public function setTemplate($template_file) : void
    {
        $this->template = $template_file;
    }

    public function setCaching(bool $caching) : void
    {
        $this->smarty->caching = $caching;
    }

    private function _prepareOutput()
    {
        $this->assign('session', $_SESSION);
        $this->assign('assets', $this->assets);
    }

    private function _validateAsset($type)
    {
        return (array_key_exists($type, $this->assets)) ? true : false;
    }

    private function _initSmarty() : void
    {
        $this->smarty = new Smarty();
        $this->smarty->setTemplateDir('templates')
        ->addPluginsDir('../Vendor/Smarty/smarty_plugins')
        ->setCompileDir('../caches/template')
        ->setCacheDir('../caches/app');
    }
}