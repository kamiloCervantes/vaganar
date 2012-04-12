<?php

class AuthController extends Zend_Controller_Action
{
    /**
     * Doctrine EntityManager
     *
     * @var Doctrine\ORM\EntityManager
     *
     *
     */
    private $_em = null;

    /**
     * Cweb DoctrineAdapter
     *
     * @var Cweb_Auth_DoctrineAdapter
     *
     */
    private $adapter = null;

    /**
     * Zend Auth 
     *
     * @var Zend_Auth
     *
     */
    private $auth = null;

    public function init()
    {
        $registry = Zend_Registry::getInstance();
        $this->_em = $registry->entitymanager;
        $this->auth = Zend_Auth::getInstance();  
    }

    public function indexAction()
    {
        // action body
    }

    public function loginAction()
    {
        $loginform = new Application_Form_Login();
        $redirector = Zend_Controller_Action_HelperBroker::getStaticHelper('Redirector');
        $this->view->loginform = $loginform;
        $request = $this->getRequest();
        if(!$this->auth->hasIdentity())
        {
        	if($this->getRequest()->isPost())
        	{
	            if($loginform->isValid($request->getPost())){
	            $this->adapter = new Cweb_Auth_DoctrineAdapter($this->_em, "Application_Model_Users","username","password");
	            $this->adapter->setIdentity($this->_getParam('username'));
	            $this->adapter->setCredential($this->_getParam('pass'));
	            $result = $this->auth->authenticate($this->adapter);
	            if($this->auth->hasIdentity())   
	            	$redirector->gotoSimpleAndExit('index', 'Carrera');
	            else{
                        $this->view->message = implode(' ' ,$result->getMessages());
                        }
	            }
	        }
        }
        else
        	$redirector->gotoSimpleAndExit('index', 'index');
    }


}



