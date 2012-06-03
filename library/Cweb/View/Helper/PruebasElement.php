<?php


class Cweb_View_Helper_PruebasElement extends Zend_View_Helper_FormElement{
    
    protected $html = '';
    /**
     * Doctrine EntityManager
     *
     * @var Doctrine\ORM\EntityManager
     *
     *
     *
     */
    private $_em = null;
    
    public function pruebasElement($name, $value, $attribs = null){
        
        $helper = new Cweb_View_Helper_CarreraElement();
        $helper->setView($this->view);
        
        $registry = Zend_Registry::getInstance();
        $this->_em = $registry->entitymanager;
        $pruebas = $this->_em->getRepository("Application_Model_PruebasCarrera")->findAll();
        
        foreach($pruebas as $prueba){
            $this->html .= $helper->carreraElement("pruebadesdehelper", "100");
        }
        
        return $this->html;
    }
}

?>
