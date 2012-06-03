<?php

class IndexController extends Zend_Controller_Action
{
    
    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $redirector = Zend_Controller_Action_HelperBroker::getStaticHelper('Redirector');
        $redirector->gotoSimpleAndExit('index','index','game');
    }


}

