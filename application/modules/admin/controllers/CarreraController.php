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
                                 ->appendFile($this->view->baseUrl().'/adm/js/jquery.autocomplete.js','text/javascript')
                                 ->appendFile($this->view->baseUrl().'/adm/js/carreras.js','text/javascript');
    }

    public function indexAction()
    {
        
    }

    public function agregarAction()
    {
       $formtest = new Admin_Form_AgregarCarrera();
       $formniveles = new Admin_Form_AgregarNivel();
       $formpremios = new Admin_Form_AgregarPremio();
       $this->view->formtest = $formtest;
       $this->view->formniveles = $formniveles;
       $this->view->formpremios = $formpremios;
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
               $ciudad = $this->_em->find("Application_Model_Ciudades", intval($ciudad_id));
               if($ciudad!= null){
                $carrera->getCiudad()->add($ciudad);                  
               }
           }
           
           $instituciones_id = explode(';', $this->getRequest()->getParam('instituciones_id'));
           foreach($instituciones_id as $institucion_id){
               $institucion = $this->_em->find("Application_Model_Instituciones", intval($institucion_id));
               if($institucion != null){
                  $carrera->getInstituciones()->add($institucion); 
               }
           }
           $niveles_data = Zend_Json_Decoder::decode($this->getRequest()->getParam('niveles_data'), Zend_Json::TYPE_ARRAY);
           foreach($niveles_data as $nivel_data){
               foreach($nivel_data as $data){
                   $nivel = new Application_Model_Niveles();
                   $nivel->setNombre($data["nombre"]);
                   $nivel->setMin_puntos($data["min_puntos"]);
                   $nivel->setRango($data["rango"]);
                   $carrera->getNiveles()->add($nivel);
               }
           }
           $premios_data = Zend_Json_Decoder::decode($this->getRequest()->getParam('premios_data'), Zend_Json::TYPE_ARRAY);
           foreach($premios_data as $premio_data){
               foreach($premio_data as $data){
                   $premio = new Application_Model_Premios();
                   $premio->setPosicion($data["posicion"]);
                   $premio->setPremio($data["premio"]);
                   $carrera->getPremios()->add($premio);
               }
           }
           $this->_em->persist($carrera);
           $this->_em->flush();
           $this->redirector->gotoSimpleAndExit('index','Carrera','admin');     
        }
    }

}





