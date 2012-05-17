<?php

class Admin_PruebaController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function agregarAction()
    {
        $formagregar = new Admin_Form_AgregarPrueba();
        $this->view->formagregar = $formagregar;
    }


}



