<?php

/**
 * @Entity
 * @Table(name="instituciones")
 */
class Application_Model_Instituciones {
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    private $id;
    
    /** @Column(type="string") */
    private $nombre;
    
    public function getId(){
        return $this->id;
    }
    
    public function getNombre(){
        return $this->nombre;
    }
    
}

?>
