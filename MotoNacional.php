<?php

class MotoNacional extends Moto{
    private $porcentajeDescuento;

    // Constructor
    public function __construct($codigo, $costo, $anio_fabricacion, $descripcion, $porcentajeInc, $disponibilidad, $porc_descuento){
        parent :: __construct($codigo, $costo, $anio_fabricacion, $descripcion, $porcentajeInc, $disponibilidad);
            $this->porcentajeDescuento = $porc_descuento;        
    }

    // Método de acceso : get
    public function getPorcentajeDescuento(){
        return $this->porcentajeDescuento;
    }

    // Método de acceso : set
    public function setPorcentajeDescuento($porc_descuento){
        $this->porcentajeDescuento = $porc_descuento;
    }

    // Método __toString
    public function __toString(){
        return parent :: __toString() . 
        "Porcentaje de descuento para la venta: " . $this->getPorcentajeDescuento() . "% \n";
    }

    // Otros métodos
    public function darPrecioVenta(){
        $valorDescuento = $this->getCosto() * ($this->getPorcentajeDescuento() / 100);
        $disponible = $this->getDisponibilidad();
        $precioVenta = -1;
        if($disponible == true){

            $precioVenta = $this->getCosto() + $this->getCosto() * ($this->aniosTranscurridos() * ($this->getIncrementoAnual() / 100));
            $precioVenta = $precioVenta - $valorDescuento;
        }
        return $precioVenta;
    }
}