<?php

/**
 * @Entity
 * @Table(name="patrocinadores")
 */
class Application_Model_Patrocinadores {
    
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    private $id;
    
    /** @Column(type="string") */
    private $nombre;
    
    /** @Column(type="string") */
    private $logo;

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }
    
     public function setLogo($logo){
        $this->logo = $logo;
    }
    
    public function getNombre(){
        return $this->nombre;
    }
    
     public function getLogo(){
        return $this->logo;
    }
    
}

?>
