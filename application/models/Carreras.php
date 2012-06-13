<?php
use Doctrine\Common\Collections\ArrayCollection;
/**
 * @Entity
 * @Table(name="carreras")
 */
class Application_Model_Carreras
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    private $id;
    
    /** @Column(type="string") */
    private $nombre;
    
    /**
     * @ManyToMany(targetEntity="Application_Model_PruebasCarrera")
     * @JoinTable(name="Carreras_PruebasCarrera",
     *      joinColumns={@JoinColumn(name="carreras_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="pruebascarrera_id", referencedColumnName="id")}
     *      )
     */
    private $pruebas;
    
    
    /** @Column(type="integer") */
    private $valor;
    
    /** @Column(type="date") */
    private $fechainicio;
    
    /** @Column(type="date") */
    private $fechafin;
    
    
    /**
     * @ManyToMany(targetEntity="Application_Model_Ciudades", cascade={"all"})
     * @JoinTable(name="carreras_ciudades",
     *      joinColumns={@JoinColumn(name="carrera_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="ciudad_id", referencedColumnName="id")}
     *      )
     */
    private $ciudad;
    
    /**
     * @ManyToMany(targetEntity="Application_Model_Instituciones", cascade={"all"})
     * @JoinTable(name="carreras_instituciones",
     *      joinColumns={@JoinColumn(name="carrera_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="institucion_id", referencedColumnName="id")}
     *      )
     */
    private $instituciones;
    
    /**
     * @ManyToMany(targetEntity="Application_Model_Niveles",cascade={"all"})
     * @JoinTable(name="carreras_niveles",
     *      joinColumns={@JoinColumn(name="carrera_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="nivel_id", referencedColumnName="id", unique=true)}
     *      )
     */
    private $niveles;
    
    /**
     * @ManyToMany(targetEntity="Application_Model_Premios",cascade={"all"})
     * @JoinTable(name="carreras_premios",
     *      joinColumns={@JoinColumn(name="carrera_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="premio_id", referencedColumnName="id", unique=true)}
     *      )
     */
    private $premios;
    
    public function __construct()
    {
        $this->pruebas = new ArrayCollection();
        $this->ciudad = new ArrayCollection();
        $this->instituciones = new ArrayCollection();
        $this->niveles = new ArrayCollection();
        $this->premios = new ArrayCollection();
    }
    
    public function setNombre($nombre){
        $this->nombre = $nombre;
    }
    
    public function setValor($valor){
        $this->valor = $valor;
    }
    
    public function setFechainicio($fechainicio){
        $this->fechainicio = $fechainicio;
    }
    
    public function setFechafin($fechafin){
        $this->fechafin = $fechafin;
    }
    
    public function getCiudad(){
        return $this->ciudad;
    }
    
    public function getPruebas(){
        return $this->pruebas;
    }
    
    public function getInstituciones(){
        return $this->instituciones;
    }
    
    public function getNiveles(){
        return $this->niveles;
    }
    
    public function getPremios(){
        return $this->premios;
    }
}

