<?php

class Admin_PatrocinadorController extends Zend_Controller_Action
{

    /**
     * Doctrine EntityManager
     *
     * @var Doctrine\ORM\EntityManager
     *
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

    public function autocompletarAction()
    {
        $this->_helper->viewRenderer->setNoRender();
        $this->_helper->getHelper('layout')->disableLayout();
        $matches[] = array();
        $matches_data[] = array();
        $index = 0;
        $query = $this->getRequest()->getParam('query');
        $patrocinadores = $this->_em->getRepository('Application_Model_Patrocinadores')->findAll();
        foreach($patrocinadores as $patrocinador){
            if($this->startsWith($patrocinador->getNombre(), $query)){
                $matches[$index] = $patrocinador->getNombre();
                $matches_data[$index] = $patrocinador->getId();
                $index++;
            }
        }
        $json = array("query" => $query, "suggestions" => $matches, "data"=> $matches_data);
        header('Content-type: application/json');
        echo Zend_Json::encode($json);


    }
    
    private function startsWith($haystack, $needle)
    {
        $length = strlen($needle);
        return (substr($haystack, 0, $length) === $needle);
    }



}





