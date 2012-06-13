<?php

class Admin_Form_AgregarPremio extends Zend_Form
{

    public function init()
    {
        $this->posicion_premio = new Zend_Form_Element_Text('posicion_premio');
        $this->posicion_premio->setLabel('Posición:');
        
        $this->valor_premio = new Zend_Form_Element_Text('valor_premio');
        $this->valor_premio->setLabel('Premio:');
        
        $this->aceptar = new Zend_Form_Element_Button('addpremio');
        $this->aceptar->setLabel('Aceptar');
        $this->aceptar->setAttrib('class', 'btn btn-primary');
    }


}

