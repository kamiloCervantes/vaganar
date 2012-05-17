<?php


class Admin_Bootstrap extends Zend_Application_Module_Bootstrap{
    
    protected function _initViewHelpers(){
      $this->bootstrap('layout');
      $layout = $this->getResource('layout');
      $view = $layout->getView();
      $view->headLink()->appendStylesheet($view->baseUrl().'/adm/css/bootstrap.css');
      //                 ->appendStylesheet($view->baseUrl().'/adm/css/bootstrap-responsive.css')
      //                 ->appendStylesheet($view->baseUrl().'/adm/css/admin.css')
      //                 ->headLink(array('rel' => 'shortcut icon','href' => $view->baseUrl().'/adm/images/favicon.ico'))
      //                 ->headLink(array('rel' => 'apple-touch-icon','href' => $view->baseUrl().'/adm/images/apple-touch-icon.png'))
      //                 ->headLink(array('rel' => 'apple-touch-icon', 'sizes' => '72x72','href' => $view->baseUrl().'/adm/images/apple-touch-icon-72x72.png'))
      //                 ->headLink(array('rel' => 'apple-touch-icon', 'sizes' => '114x114','href' => $view->baseUrl().'/adm/images/apple-touch-icon-114x114.png'));
      $view->headScript()->appendFile($view->baseUrl().'/js/jquery.js','text/javascript')
                         ->appendFile($view->baseUrl().'/adm/js/bootstrap-transition.js','text/javascript')
                         ->appendFile($view->baseUrl().'/adm/js/bootstrap-alert.js','text/javascript')
                         ->appendFile($view->baseUrl().'/adm/js/bootstrap-modal.js','text/javascript')
                         ->appendFile($view->baseUrl().'/adm/js/bootstrap-dropdown.js','text/javascript')
                         ->appendFile($view->baseUrl().'/adm/js/bootstrap-scrollspy.js','text/javascript')
                         ->appendFile($view->baseUrl().'/adm/js/bootstrap-tab.js','text/javascript')
                         ->appendFile($view->baseUrl().'/adm/js/bootstrap-tooltip.js','text/javascript')
                         ->appendFile($view->baseUrl().'/adm/js/bootstrap-popover.js','text/javascript')
                         ->appendFile($view->baseUrl().'/adm/js/bootstrap-button.js','text/javascript')
                         ->appendFile($view->baseUrl().'/adm/js/bootstrap-collapse.js','text/javascript')
                         ->appendFile($view->baseUrl().'/adm/js/bootstrap-carousel.js','text/javascript')
                         ->appendFile($view->baseUrl().'/adm/js/bootstrap-typeahead.js','text/javascript')
                         ->appendFile($view->baseUrl().'/adm/js/script.js','text/javascript');
      Zend_Session::start();
    }
}

?>
