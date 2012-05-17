<?php

class Admin_PatrocinadorController extends Zend_Controller_Action
{
    /**
     * Doctrine EntityManager
     *
     * @var Doctrine\ORM\EntityManager
     *
     *
     */
    private $_em = null;
    
    private $redirector = null;

    public function init()
    {
        $registry = Zend_Registry::getInstance();
        $this->_em = $registry->entitymanager;
        $this->redirector = Zend_Controller_Action_HelperBroker::getStaticHelper('Redirector');
    }

    public function indexAction()
    {
        $patrocinadores = $this->_em->getRepository('Application_Model_Patrocinadores')->findAll();
        $this->view->patrocinadores = $patrocinadores;
    }

    public function agregarAction()
    {
        $formpatrocinador = new Admin_Form_AgregarPatrocinador();
        $this->view->formpatrocinador = $formpatrocinador;
        
        if ($this->getRequest()->isPost() && $this->view->formpatrocinador->isValid($this->_getAllParams()))
        {
            $patrocinador = new Application_Model_Patrocinadores();
            $patrocinador->setNombre($this->getRequest()->getParam("nombre"));
            $patrocinador->setLogo($this->getRequest()->getParam("logo"));
            $this->_em->persist($patrocinador);
            $this->_em->flush();
            
            $this->redirector->gotoSimpleAndExit('index','Patrocinador','admin');
        }

    }


}



