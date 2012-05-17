<?php

class Admin_Form_AgregarPrueba extends Zend_Form
{

    public function init()
    {
        $this->setMethod('post');
        $this->setAction('/admin/Prueba/agregar'); 
        
        $this->titulo = new Zend_Form_Element_Text('titulo');
        $this->titulo->setLabel('Título de la prueba:')
                       ->setRequired(true)
                       ->setAttrib('class', 'width-total')
                       ->addValidator('NotEmpty');
        
        $this->logo = new Zend_Form_Element_Text('titulo');
        $this->logo->setLabel('Logo de la prueba:')
                       ->setRequired(true)
                       ->setAttrib('class', 'width-total')
                       ->addValidator('NotEmpty');
        
        $this->patrocinador = new Zend_Form_Element_Text('patrocinador');
        $this->patrocinador->setLabel('Patrocinador de la prueba:')
                       ->setRequired(true)
                       ->setAttrib('class', 'width-total')
                       ->addValidator('NotEmpty');
        
        $this->enunciado = new Zend_Form_Element_Textarea('enunciado');
        $this->enunciado->setLabel('Enunciado de la prueba:')
                       ->setRequired(true)
                       ->setAttrib('rows', '10')
                       ->setAttrib('class', 'width-total')
                       ->addValidator('NotEmpty');
        
        $this->respuesta = new Zend_Form_Element_Text('respuesta');
        $this->respuesta->setLabel('Respuesta correcta:')
                       ->setRequired(true)
                       ->setAttrib('class', 'width-total')
                       ->addValidator('NotEmpty');
        
        $this->submit = new Zend_Form_Element_Submit('Guardar');
        $this->submit->setAttrib('class', 'btn btn-primary')
                     ->setIgnore('true');
    }


}

