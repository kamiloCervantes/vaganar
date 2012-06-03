<?php
use Doctrine\Common\Collections\ArrayCollection;
/**
 * @Entity
 * @Table(name="ciudades")
 */
class Application_Model_Ciudades {
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    private $id;
    
    /** @Column(type="string") */
    private $ciudad;
    
    /** @Column(type="string") */
    private $departamento;
    
    /** @Column(type="string") */
    private $pais;
    
    /**
     * @ManyToMany(targetEntity="Application_Model_Instituciones")
     * @JoinTable(name="Ciudades_Instituciones",
     *      joinColumns={@JoinColumn(name="ciudades_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="instituciones_id", referencedColumnName="id")}
     *      )
     */
    private $instituciones;
    
    public function __construct()
    {
        $this->instituciones = new ArrayCollection();
    }
    
    public function getCiudad(){
        return $this->ciudad;
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function getInstituciones(){
        return $this->instituciones;
    }
    
}

?>
