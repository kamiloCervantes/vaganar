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
     *      joinColumns={@JoinColumn(name="pruebas_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="patrocinadores_id", referencedColumnName="id", unique=true)}
     *      )
     */
    protected $patrocinadores;
    
    /** @Column(type="string") */
    private $respuesta; 
    
    public function __construct() {
        $this->patrocinadores = new ArrayCollection();
    }
}

?>
