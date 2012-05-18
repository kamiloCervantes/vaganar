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
    
    public function setTitulo($titulo){
        $this->titulo = $titulo;
    }
    
    public function setLogo_prueba($logo_prueba){
        $this->logo_prueba = $logo_prueba;
    }
    
    public function setEnunciado($enunciado){
        $this->enunciado = $enunciado;
    }
    
    public function getTitulo(){
        return $this->titulo;
    }
    
    public function getLogo_prueba(){
        return $this->logo_prueba;
    }
    
    public function getEnunciado(){
        return $this->enunciado;
    }
}

?>
