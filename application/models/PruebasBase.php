<?php


/**
 * @MappedSuperclass 
 */
class Application_Model_PruebasBase {
    
    
    /** @Column(type="string") */
    protected $titulo;
        
    /** @Column(type="string") */
    protected $logo_prueba;
    
    /** @Column(type="string") */
    protected $enunciado;
    
}

?>
