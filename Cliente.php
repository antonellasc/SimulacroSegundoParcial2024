<?php

class Cliente{
    private $nombre;
    private $apellido;
    private $dadoBaja;
    private $tipoDoc;
    private $numDoc;

    // Constructor de la clase
    public function __construct($name, $surname, $discharged, $tipo_doc, $nro_doc){
        $this->nombre = $name;
        $this->apellido = $surname;
        $this->dadoBaja = $discharged;
        $this->tipoDoc = $tipo_doc;
        $this->numDoc = $nro_doc;
    }

    // Métodos de acceso de la clase : GET 
    public function getNombre(){
        return $this->nombre;
    }

    public function getApellido(){
        return $this->apellido;
    }

    public function getEstadoCliente(){
        return $this->dadoBaja;
    }

    public function getTipoDoc(){
        return $this->tipoDoc;
    }

    public function getNroDoc(){
        return $this->numDoc;
    }

    // Métodos de acceso de la clase : SET 
    public function setNombre($name){
        $this->nombre = $name;
    }

    public function setApellido($surname){
        $this->apellido = $surname;
    }

    public function setEstadoCliente($discharged){
        $this->dadoBaja = $discharged;
    }

    public function setTipoDoc($tipo_doc){
        $this->tipoDoc = $tipo_doc;
    }

    public function setNroDoc($nro_doc){
        $this->numDoc = $nro_doc;
    }

    // Método to string
    public function __toString(){
        $verifica = $this->getEstadoCliente();
        $estadoCliente = "";
        if($verifica == true){
            $estadoCliente = "si";
        } else{
            $estadoCliente = "no";
        }

        return "\n Nombre: " . $this->getNombre() . "\n" . "Apellido: " . $this->getApellido() . "\n" . "¿Está dado de baja?: " . $estadoCliente . "\n" . 
        "Tipo documento: " . $this->getTipoDoc() . "\n" . "Número de documento: " . $this->getNroDoc() . "\n —————————————————————————— \n";
        
    }

    // Otros métodos 

}