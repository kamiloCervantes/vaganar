<?php

class Game_ZonaRetosController extends Zend_Controller_Action
{

    public function init()
    {
        $this->view->headScript()->appendFile($this->view->baseUrl().'/js/jquery.stopwatch.js','text/javascript')
                                 ->appendFile($this->view->baseUrl().'/js/zonaretos.js','text/javascript');
    }

    public function indexAction()
    {
        // action body
    }


}

