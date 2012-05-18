<?php

class Admin_PruebaController extends Zend_Controller_Action
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
        $this->redirector = Zend_Controller_Action_HelperBroker::getStaticHelper('Redirector');
        $registry = Zend_Registry::getInstance();
        $this->_em = $registry->entitymanager;
        $this->view->headScript()->appendFile($this->view->baseUrl().'/adm/js/autocompletar_patrocinador.js','text/javascript')
                                 ->appendFile($this->view->baseUrl().'/adm/js/jquery.autocomplete.js','text/javascript');
    }

    public function indexAction()
    {
        $pruebas =  $this->_em->getRepository('Application_Model_PruebasCarrera')->findAll();
        $this->view->pruebas = $pruebas;
    }

    public function agregarAction()
    {
        $formagregar = new Admin_Form_AgregarPrueba(array('tipo_prueba'=> 'reto'));
        $this->view->formagregar = $formagregar;
        
        if ($this->getRequest()->isPost() && $this->view->formagregar->isValid($this->_getAllParams()))
        {
              $prueba = new Application_Model_PruebasCarrera();
              $prueba->setEnunciado($this->getRequest()->getParam('enunciado'));
              $prueba->setLogo_prueba($this->getRequest()->getParam('logo'));
              $patrocinador = $this->_em->find('Application_Model_Patrocinadores', $this->getRequest()->getParam('patrocinador_id'));
              $prueba->getPatrocinadores()->add($patrocinador);
              $prueba->setTitulo($this->getRequest()->getParam('titulo'));
              $prueba->setRespuesta($this->getRequest()->getParam('respuesta'));
              $this->_em->persist($prueba);
              $this->_em->flush();
              
              $this->redirector->gotoSimpleAndExit('index','Prueba','admin');
        }
    }


}



