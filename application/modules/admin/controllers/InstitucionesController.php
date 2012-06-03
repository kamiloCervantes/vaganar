<?php

class Admin_InstitucionesController extends Zend_Controller_Action
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

    public function init()
    {
        $registry = Zend_Registry::getInstance();
        $this->_em = $registry->entitymanager;
    }

    public function indexAction()
    {
        
    }

    public function autocompletarAction()
    {
        $this->_helper->viewRenderer->setNoRender();
        $this->_helper->getHelper('layout')->disableLayout();
        
        $matches[] = array();
        $matches_data[] = array();
        $index = 0;
        $query = $this->getRequest()->getParam('query');
        $ciudades_query = explode(',',$this->getRequest()->getParam('ciudades'));
        $ciudades = $this->_em->getRepository('Application_Model_Ciudades')->findBy(array('ciudad' => $ciudades_query));
        //$instituciones = $this->_em->getRepository('Application_Model_Ciudades')->findAll();

        foreach($ciudades as $ciudad){
            foreach($ciudad->getInstituciones() as $institucion){
                 if($this->startsWith($institucion->getNombre(), $query)){
                    $matches[$index] = $institucion->getNombre().' - '.$ciudad->getCiudad();
                    $matches_data[$index] = $institucion->getId();
                    $index++;
                }
            }
        }
        $json = array("query" => $query, "suggestions" => $matches, "data"=> $matches_data);
        
        //header('Content-type: application/json');
        echo Zend_Json::encode($json);
    }
    
    private function startsWith($haystack, $needle)
    {
        $length = strlen($needle);
        return (strcasecmp(substr($haystack, 0, $length) ,$needle)) === 0;
    }


}



