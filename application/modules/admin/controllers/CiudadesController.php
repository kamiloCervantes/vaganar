<?php

class Admin_CiudadesController extends Zend_Controller_Action
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
        // action body
    }

    public function autocompletarAction()
    {
        $this->_helper->viewRenderer->setNoRender();
        $this->_helper->getHelper('layout')->disableLayout();
        
        $matches[] = array();
        $matches_data[] = array();
        $index = 0;
        $query = $this->getRequest()->getParam('query');
        $ciudades = $this->_em->getRepository('Application_Model_Ciudades')->findAll();
        foreach($ciudades as $ciudad){
            if($this->startsWith($ciudad->getCiudad(), $query)){
                $matches[$index] = $ciudad->getCiudad();
                $matches_data[$index] = $ciudad->getId();
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
        return (strcasecmp(substr($haystack, 0, $length) ,$needle)) === 0;
    }


}



