<?php

class MotoImportada extends Moto{
    private $paisImportador;
    private $impuestoXImportacion;

    // Constructor
    public function __construct($codigo, $costo, $anio_fabricacion, $descripcion, $porcentajeInc, $disponibilidad, $pais_Imp, $impuesto_Import){
        parent :: __construct($codigo, $costo, $anio_fabricacion, $descripcion, $porcentajeInc, $disponibilidad);
        $this->paisImportador = $pais_Imp;
        $this->impuestoXImportacion = $impuesto_Import;
    }

    // Método de acceso : get
    public function getPaisImportador(){
        return $this->paisImportador;
    }

    public function getImpuestoXImport(){
        return $this->impuestoXImportacion;
    }

    // Método de acceso : set
    public function setPaisImportador($pais_Imp){
        $this->paisImportador = $pais_Imp;
    }

    public function setImpuestoXImport($impuesto_Import){
        $this->impuestoXImportacion = $impuesto_Import;
    }

    // Método __toString
    public function __toString(){
        return parent :: __toString() . 
        ">>País importador: " . $this->getPaisImportador() . "\n" . 
        ">>Impuesto por ingreso al país: $" . $this->getImpuestoXImport() . "\n" . 
        "\n"; 
    }

    // Otros métodos
    public function darPrecioVenta(){
        // modificarlo porque está mal, hay que llamar al método del parent y añadirle los impuestos si el precio es != -1
        $precio = parent :: darPrecioVenta();
        $precioVenta = -1;
        if($precio > 0){
            $precioVenta = $precio + $this->getImpuestoXImport();
        }

        return $precioVenta;
    }
}