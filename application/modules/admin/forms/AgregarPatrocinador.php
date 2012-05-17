<?php

class Admin_Form_AgregarPatrocinador extends Zend_Form
{

    public function init()
    {
        $this->setMethod('post');
        $this->setAction('/admin/Patrocinador/agregar'); 
        
        $this->nombre = new Zend_Form_Element_Text('nombre');
        $this->nombre->setLabel('Nombre del patrocinador:')
                       ->setRequired(true)
                       ->addValidator('NotEmpty');
        
        $this->logo = new Zend_Form_Element_Text('logo');
        $this->logo->setLabel('Logo del patrocinador:')
                       ->setRequired(true)
                       ->addValidator('NotEmpty');
        
        $this->submit = new Zend_Form_Element_Submit('Guardar');
        $this->submit->setAttrib('class', 'btn btn-primary')
                     ->setIgnore('true');
    }


}

