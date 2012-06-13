<?php
/**
 * @Entity
 * @Table(name="premios")
 */
class Application_Model_Premios {
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    private $id;
    
    /** @Column(type="string") */
    private $posicion;
    
    /** @Column(type="integer") */
    private $premio;
    
    public function setPosicion($posicion){
        $this->posicion = $posicion;
    }
    
    public function setPremio($premio){
        $this->premio = $premio;
    }
}

?>
