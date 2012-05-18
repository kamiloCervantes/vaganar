<?php

class Admin_Form_AgregarPrueba extends Zend_Form
{
    private $tipo_prueba;

    public function init()
    {
        $this->setMethod('post');
        $this->setAction('/admin/Prueba/agregar'); 
        
        $this->titulo = new Zend_Form_Element_Text('titulo');
        $this->titulo->setLabel('Título de la prueba:')
                       ->setRequired(true)
                       ->setAttrib('class', 'width-total')
                       ->addValidator('NotEmpty');
        
        $this->logo = new Zend_Form_Element_Text('logo');
        $this->logo->setLabel('Logo de la prueba:')
                       ->setRequired(true)
                       ->setAttrib('class', 'width-total')
                       ->addValidator('NotEmpty');
        
        $this->patrocinador = new Zend_Form_Element_Text('patrocinador');
        $this->patrocinador->setLabel('Patrocinador de la prueba:')
                       ->setRequired(true)
                       ->setAttrib('class', 'width-total')
                       ->addValidator('NotEmpty');
        
        $this->patrocinador_id = new Zend_Form_Element_Hidden('patrocinador_id');
        
        $this->enunciado = new Zend_Form_Element_Textarea('enunciado');
        $this->enunciado->setLabel('Enunciado de la prueba:')
                       ->setRequired(true)
                       ->setAttrib('rows', '10')
                       ->setAttrib('class', 'width-total')
                       ->addValidator('NotEmpty');
        
        if($this->tipo_prueba == 'carrera'){
            $this->respuesta = new Zend_Form_Element_Text('respuesta');
            $this->respuesta->setLabel('Respuesta correcta:')
                       ->setRequired(true)
                       ->setAttrib('class', 'width-total')
                       ->addValidator('NotEmpty');
        }
        
        if($this->tipo_prueba == 'reto'){
            $this->respuesta = new Zend_Form_Element_Text('respuesta');
            $this->respuesta->setLabel('Respuesta correcta:')
                       ->setRequired(true)
                       ->setAttrib('class', 'width-total')
                       ->addValidator('NotEmpty');
        }

        $this->submit = new Zend_Form_Element_Submit('Guardar');
        $this->submit->setAttrib('class', 'btn btn-primary')
                     ->setIgnore('true');
    }
    
    public function setTipo_prueba($tipo_prueba){
        $this->tipo_prueba = $tipo_prueba;
    }


}

