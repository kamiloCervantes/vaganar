<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    protected function _initAutoload()
    {
        $moduleloader = new Zend_Application_Module_Autoloader(array(
            'namespace' => '',
            'basePath' => dirname(__FILE__),
        ));
        return $moduleloader;

    }
    
    protected function _initViewHelpers()
    {
        $auth = Zend_Auth::getInstance();
        $this->bootstrap('layout');
        $layout = $this->getResource('layout');
        $view = $layout->getView();
        $view->identity = $auth->hasIdentity();
        $view->headLink()->appendStylesheet($view->baseUrl().'/css/reset.css')
                         ->appendStylesheet($view->baseUrl().'/css/estilos.css')
                         ->appendStylesheet($view->baseUrl().'/js/fancybox/jquery.fancybox-1.3.4.css');
        $view->headScript()->appendFile($view->baseUrl().'/js/jquery.js','text/javascript')
                           ->appendFile($view->baseUrl().'/js/jquery.json-2.3.min.js','text/javascript')
                           ->appendFile($view->baseUrl().'/js/script.js','text/javascript')                           
                           ->appendFile($view->baseUrl().'/js/fancybox/jquery.mousewheel-3.0.4.pack.js','text/javascript')
                           ->appendFile($view->baseUrl().'/js/fancybox/jquery.fancybox-1.3.4.pack.js','text/javascript');
        
    }
    
    protected function _initDoctrine() {
        $conn = Cweb_Db_Adapter::getInstance('../application/configs/dataConnectDb.xml');
    	$registry = Zend_Registry::getInstance();
        return $registry->entitymanager;
    }
    
    protected function _initTranslator(){
        $translator = new Zend_Translate(
                    'array',
                    '../resources/languages',
                    'es',
                    array('scan' => Zend_Translate::LOCALE_DIRECTORY)
            );
            Zend_Validate_Abstract::setDefaultTranslator($translator);
    }
}

