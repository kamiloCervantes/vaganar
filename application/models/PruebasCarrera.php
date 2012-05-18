<?php
use Doctrine\Common\Collections\ArrayCollection;
/**
 * @Entity
 * @Table(name="pruebas_carrera")
 */
class Application_Model_PruebasCarrera extends Application_Model_PruebasBase{
    
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    private $id;
    
    /**
     * @ManyToMany(targetEntity="Application_Model_Patrocinadores")
     * @JoinTable(name="pruebascarrera_patrocinadores",
     *      joinColumns={@JoinColumn(name="pruebas_id", referencedColumnName="id", unique="true")},
     *      inverseJoinColumns={@JoinColumn(name="patrocinadores_id", referencedColumnName="id", unique=false)}
     *      )
     */
    protected $patrocinadores;
    
    /** @Column(type="string") */
    private $respuesta; 
    
    public function __construct() {
        $this->patrocinadores = new ArrayCollection();
    }
    
    public function setRespuesta($respuesta){
        $this->respuesta = $respuesta;
    }
    
    public function getPatrocinadores(){
        return $this->patrocinadores;
    }
    
}

?>
