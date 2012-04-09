<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    public function _initViewHelpers()
    {
        $this->bootstrap('layout');
        $layout = $this->getResource('layout');
        $view = $layout->getView();
        $view->headLink()->appendStylesheet($view->baseUrl().'/css/reset.css')
                         ->appendStylesheet($view->baseUrl().'/css/estilos.css');
        
    }
}

