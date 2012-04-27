<?php

class CarreraController extends Zend_Controller_Action
{

    public function init()
    {
        $this->view->headScript()->appendFile($this->view->baseUrl().'/js/carrera.js','text/javascript');
    }

    public function indexAction()
    {
        // action body
    }


}

