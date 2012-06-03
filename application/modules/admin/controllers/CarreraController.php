<?php

class Admin_CarreraController extends Zend_Controller_Action
{

    /**
     * Doctrine EntityManager
     *
     * @var Doctrine\ORM\EntityManager
     *
     */
    private $_em = null;

    private $redirector = null;

    public function init()
    {
        $this->redirector = Zend_Controller_Action_HelperBroker::getStaticHelper('Redirector');
        $registry = Zend_Registry::getInstance();
        $this->_em = $registry->entitymanager;
        $this->view->headScript()->appendFile($this->view->baseUrl().'/adm/js/autocompletar_ciudades.js','text/javascript')
                                 ->appendFile($this->view->baseUrl().'/adm/js/jquery.autocomplete.js','text/javascript');
    }

    public function indexAction()
    {
        
    }

    public function agregarAction()
    {
       $formtest = new Admin_Form_AgregarCarrera();
       $this->view->formtest = $formtest;
       if ($this->getRequest()->isPost() && $this->view->formtest->isValid($this->_getAllParams()))
       {
           $carrera = new Application_Model_Carreras();
           $carrera->setNombre($this->getRequest()->getParam("nombre"));
           $carrera->setValor($this->getRequest()->getParam("valor"));
           $carrera->setFechainicio(new \DateTime($this->getRequest()->getParam("fechainicio")));
           $carrera->setFechafin(new \DateTime($this->getRequest()->getParam("fechafin")));
           $pruebas = $this->getRequest()->getParam("pruebas");
           foreach($pruebas as $prueba){
              if($prueba != '0'){
                  $tmp = $this->_em->find("Application_Model_PruebasCarrera", $prueba);
                  $carrera->getPruebas()->add($tmp);
              }
           }
           $ciudades_id = explode(';', $this->getRequest()->getParam('ciudades_id'));
           foreach($ciudades_id as $ciudad_id){
               $ciudad = $this->_em->find("Application_Model_Ciudades", $ciudad_id);
               $carrera->getCiudad()->add($ciudad);
           }
           $instituciones_id = explode(';', $this->getRequest()->getParam('instituciones_id'));
           foreach($instituciones_id as $institucion_id){
               $institucion = $this->_em->find("Application_Model_Instituciones", $institucion_id);
               $carrera->getInstituciones()->add($institucion);
           }
           $this->_em->persist($carrera);
           $this->_em->flush();
           $this->redirector->gotoSimpleAndExit('index','Carrera','admin');     
        }
    }

}





