<?php

class Moto{
    private $codigo_m;
    private $costo_m;
    private $anioFabricacion;
    private $descrip_m;
    private $porcent_inc;
    private $estaDisponible;

    // Método constructor de la clase
    public function __construct($codigo, $costo, $anio_fabricacion, $descripcion, $porcentajeInc, $disponibilidad){
        $this->codigo_m = $codigo;
        $this->costo_m = $costo;
        $this->anioFabricacion = $anio_fabricacion;
        $this->descrip_m = $descripcion;
        $this->porcent_inc = $porcentajeInc;
        $this->estaDisponible = $disponibilidad;
    }

    // Método de acceso : GET
    public function getCodigo(){
        return $this->codigo_m;
    }

    public function getCosto(){
        return $this->costo_m;
    }

    public function getAnioFabricacion(){
        return $this->anioFabricacion;
    }

    public function getDescripcion(){
        return $this->descrip_m;
    }

    public function getIncrementoAnual(){
        return $this->porcent_inc;
    }

    public function getDisponibilidad(){
        return $this->estaDisponible;
    }

    // Método de acceso : SET
    public function setCodigo($codigo){
        $this->codigo_m = $codigo;
    }

    public function setCosto($costo){
        $this->costo_m = $costo;
    }

    public function setAnioFabricacion($anio_fabricacion){
        $this->anioFabricacion = $anio_fabricacion;
    }

    public function setDescripcion($descripcion){
        $this->descrip_m = $descripcion;
    }

    public function setIncrementoAnual($porcentajeInc){
        $this->porcent_inc = $porcentajeInc;
    }

    public function setDisponibilidad($disponibilidad){
        $this->estaDisponible = $disponibilidad;
    }

    // Método to string
    public function __toString(){
        $verifica = $this->getDisponibilidad();
        $estadoMoto = "";
        if($verifica == true){
            $estadoMoto = "si";
        } else{
            $estadoMoto = "no";
        }

        return "\n" . 
        ">>Código: " . $this->getCodigo() . "\n" . 
        ">>Precio costo: $" . $this->getCosto() . "\n" . 
        ">>Precio para la venta: $" . $this->darPrecioVenta() . "\n" . 
        ">>Año de fabricación: " . $this->getAnioFabricacion() . "\n" .
        ">>Descripción: " . $this->getDescripcion() . "\n" . 
        ">>Porc. de incremento anual: " . $this->getIncrementoAnual() . "% \n" .
        ">>¿Está disponible a la venta?: " . $estadoMoto . "\n";
    }

    // Otras funciones
    public function aniosTranscurridos(){
        // Calcula la cantidad de años transcurridos desde la fabricación de una moto
        $anioActual = intval(date('Y'));
        $aniosDiferencia = $anioActual - $this->getAnioFabricacion();

        return $aniosDiferencia;
    }

    public function darPrecioVenta(){
        $disponible = $this->getDisponibilidad();
        $precioVenta = -1;
        if($disponible == true){
            $precioVenta = $this->getCosto() + $this->getCosto() * ($this->aniosTranscurridos() * ($this->getIncrementoAnual() / 100));
        }
        return $precioVenta;
    }


}