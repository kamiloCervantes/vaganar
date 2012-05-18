<?php

/**
 * @Entity
 * @Table(name="pruebas") 
 */
class Application_Model_Pruebas {
    
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    private $id;
    
    /** @Column(type="string") */
    private $titulo;
    
    /** @Column(type="string") */
    private $tipo_prueba;
    
    /** @Column(type="string") */
    private $logo_prueba;
    
    /** @Column(type="string") */
    private $enunciado;
    
    /** @Column(type="integer") */
    private $puntos;
}

?>
