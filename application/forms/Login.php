<?php

class Application_Form_Login extends Zend_Form
{

    public function init()
    {
        $this->setMethod('post');
        $this->setAction('/Auth/login'); 
        
        $this->username = new Zend_Form_Element_Text('username');
        $this->username->setLabel('Nombre de usuario:')
                       ->setRequired(true)
                       ->addValidator('NotEmpty');
        
        $this->pass = new Zend_Form_Element_Password('pass');
        $this->pass->setLabel('Contraseña:')
                   ->setRequired(true)
                   ->addValidator('NotEmpty');
        
        $this->submit = new Zend_Form_Element_Submit('Entrar');
        $this->submit->setAttrib('class', 'btn btn-primary')
                     ->setIgnore('true');
        
        $this->setElementDecorators(array(
            array('ViewHelper'),
            array(array('data' => 'HtmlTag'),  array('tag' =>'dd')),
            array('Label', array('tag' => 'dt')),
            array('Errors', array('class' => 'alert error', 'placement' => 'APPEND'))
        ));
        
        $this->submit->setDecorators(array(
                                    array('ViewHelper'),
                                    array(array('data' => 'HtmlTag'),  array('tag' =>'dd'))
                                    ));
    }


}

