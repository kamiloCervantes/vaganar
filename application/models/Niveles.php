<?php

/**
 * @Entity
 * @Table(name="niveles")
 */
class Application_Model_Niveles {
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    private $id;
    
    /** @Column(type="string") */
    private $nombre;
    
    /** @Column(type="integer") */
    private $min_puntos;
    
    /** @Column(type="string") */
    private $rango;
    
    public function getId(){
        return $this->id;
    }
    
    public function setNombre($nombre){
        $this->nombre = $nombre;
    }
    
    public function setMin_puntos($min_puntos){
        $this->min_puntos = $min_puntos;
    }
    
    public function setRango($rango){
        $this->rango = $rango;
    }
}

?>
