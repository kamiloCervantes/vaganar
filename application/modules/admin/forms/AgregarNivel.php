<?php

class Admin_Form_AgregarNivel extends Zend_Form
{

    public function init()
    {
        $this->nombre = new Zend_Form_Element_Text('nombre_nivel');
        $this->nombre->setLabel('Nombre del nivel:');
        
        $this->min_puntos = new Zend_Form_Element_Text('min_puntos_nivel');
        $this->min_puntos->setLabel('Puntos minimos para lograr el nivel:');
        
        $this->rango = new Zend_Form_Element_Text('rango_nivel');
        $this->rango->setLabel('Rango del nivel:');
        
        $this->aceptar = new Zend_Form_Element_Button('addnivel');
        $this->aceptar->setLabel('Aceptar');
        $this->aceptar->setAttrib('class', 'btn btn-primary');
    }


}

