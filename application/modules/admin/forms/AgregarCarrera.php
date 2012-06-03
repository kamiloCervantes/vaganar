<?php

class Admin_Form_AgregarCarrera extends Zend_Form
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
        
        $this->setMethod('post');
        
        $this->nombre = new Zend_Form_Element_Text('nombre');
        $this->nombre->setLabel('Nombre de la Carrera:')
                       ->setRequired(true)
                       ->setAttrib('class', 'width-total')
                       ->addValidator('NotEmpty');
        
        $this->fechainicio = new Zend_Form_Element_Text('fechainicio');
        $this->fechainicio->setLabel('Fecha de inicio de la carrera:')
                       ->setRequired(true)
                       ->setAttrib('class', 'width-total')
                       ->addValidator('NotEmpty');
        
        $this->fechafin = new Zend_Form_Element_Text('fechafin');
        $this->fechafin->setLabel('Fecha de finalización de la carrera:')
                       ->setRequired(true)
                       ->setAttrib('class', 'width-total')
                       ->addValidator('NotEmpty');
        
        $pruebas = $this->_em->getRepository("Application_Model_PruebasCarrera")->findAll();
        $pruebas_members[] = null;
        
        
        foreach($pruebas as $prueba){
            $prueba_data = array("titulo" => $prueba->getTitulo(), 
                        "patrocinador" => $prueba->getPatrocinadores()->get(0)->getNombre(),
                        "patrocinador_logo" => $prueba->getPatrocinadores()->get(0)->getLogo(),
                        "enunciado" => $prueba->getEnunciado(),
                        "logo" => $prueba->getLogo_prueba(),
                        "respuesta" => $prueba->getRespuesta());

            $prueba_element = new Cweb_Form_Element_Carrera('prueba'.$prueba->getId());
            $prueba_element->setAttribs($prueba_data);
            $prueba_element->setValue($prueba->getId());
            $this->addElement($prueba_element);
            $pruebas_members[] = 'prueba'.$prueba->getId();    
        }
        if(!$pruebas_members){
            $this->addDisplayGroup($pruebas_members,'pruebas',array('legend' => 'Pruebas de la carrera'));
            $pruebas_group = $this->getDisplayGroup('pruebas');
            $pruebas_group->setDecorators(array(
                        'FormElements',
                        'Fieldset',
                        array('HtmlTag',array('tag'=>'div','class'=>'pruebas_scroll'))
            ));
        }
        

        $this->ciudad = new Zend_Form_Element_Text('ciudad');
        $this->ciudad->setLabel('Ciudades de la carrera:')
                       ->setAttrib('class', 'width-total');
        
        $this->ciudades_id = new Zend_Form_Element_Hidden('ciudades_id');
        
        $this->institucion = new Zend_Form_Element_Text('institucion');
        $this->institucion->setLabel('Instituciones de la carrera:')
                          ->setAttrib('class', 'width-total');
        
        $this->instituciones_id = new Zend_Form_Element_Hidden('instituciones_id');
        
        $this->valor = new Zend_Form_Element_Text('valor');
        $this->valor->setLabel('Valor de la carrera:')
                       ->setRequired(true)
                       ->setAttrib('class', 'width-total')
                       ->addValidator('NotEmpty');
        
        $this->submit = new Zend_Form_Element_Submit('Guardar');
        $this->submit->setAttrib('class', 'btn btn-primary')
                     ->setIgnore('true');
    }

}

