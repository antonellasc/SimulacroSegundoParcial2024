<?php

class Venta{
    private $numero_v;
    private $fecha_v;
    private $objCliente;
    private $arrayMoto;
    private $precioFinal;

    // Método constructor de la clase
    public function __construct($nroVenta, $fechaVenta, $obj_Cliente, $array_Moto, $precio_final){
        $this->numero_v = $nroVenta;
        $this->fecha_v = $fechaVenta;
        $this->objCliente = $obj_Cliente;
        $this->arrayMoto = $array_Moto;
        $this->precioFinal = $precio_final;
    }

    // Método de acceso : GET
    public function getNumeroVenta(){
        return $this->numero_v;
    }

    public function getFechaVenta(){
        return $this->fecha_v;
    }

    public function getObjCliente(){
        return $this->objCliente;
    }

    public function getArrayMoto(){
        return $this->arrayMoto;
    }

    public function getPrecioFinal(){
        return $this->precioFinal;
    }

    // Método de acceso : SET
    public function setNumeroVenta($nroVenta){
        $this->numero_v = $nroVenta;
    }

    public function setFechaVenta($fechaVenta){
        $this->fecha_v = $fechaVenta;
    }

    public function setObjCliente($obj_Cliente){
        $this->objCliente = $obj_Cliente;
    }

    public function setArrayMoto($array_Moto){
        $this->arrayMoto = $array_Moto;
    }

    public function setPrecioFinal($precio_final){
        $this->precioFinal = $precio_final;
    }

    // Método to string
    public function __toString(){
        return "————————————————————————" . "\n Venta número " . $this->getNumeroVenta() . ": \n" . "Fecha: " . $this->getFechaVenta() . "\n" . "Cliente: " . $this->getObjCliente() . 
        "Motos vendidas: " . $this->mostrarArrayMotos() . "\n" . "Precio final de la venta: $" . $this->getPrecioFinal() . "\n —————————————————————————"; 
        
    }


    // Funciones solicitadas por el enunciado
    public function incorporarMoto($objMoto){
        // 5. Implementar el método incorporarMoto($objMoto) que recibe por parámetro un objeto moto y lo incorpora a la colección de motos de la venta, siempre y cuando sea posible la venta.
        // El método cada vez que incorpora una moto a la venta, debe actualizar la variable instancia precio final de la venta.
        // Utilizar el método que calcula el precio de venta de la moto donde crea necesario.
        $motosVendidas = $this->getArrayMoto();
        $estaDisp = $objMoto->getDisponibilidad();
        $precioActualVtas = $this->getPrecioFinal();
        $precioUnMoto = $objMoto->darPrecioVenta();
        $precio_Final = 0;
        if($estaDisp == true){
            $motosVendidas[] = $objMoto;
            // cambiar el parentesis del set porque no es responsabilidad del set realizar una operación
            $precio_Final = $precioActualVtas + $precioUnMoto;
            $this->setPrecioFinal($precio_Final);

        }

    }

    // método retornarTotalVentaNacional
    public function retornarTotalVentaNacional(){
        // retorna  la sumatoria del precio venta de cada una de las motos Nacionales vinculadas a la venta
        $totalVenta = 0;
        $coleccionMotos = $this->getArrayMoto();
        $colMotoNacional = [];
        foreach($coleccionMotos as $moto){
            if($moto instanceof MotoNacional === true)
            $colMotoNacional[] = $moto;
        }
        foreach($colMotoNacional as $motoNacional){
            $precioMotoN = $motoNacional->darPrecioVenta();
            if($precioMotoN != -1){
                $totalVenta = $totalVenta + $precioMotoN;
            }
        }
        return $totalVenta;
    }

    // 
    public function retornarMotosImportadas(){
        // retorna una colección de motos importadas vinculadas a la venta. 
        // Si la venta solo se corresponde con motos Nacionales la colección 
        // retornada debe ser vacía
        $coleccionMotosImp = null;
        $coleccionMotos = $this->getArrayMoto();
        foreach($coleccionMotos as $motoImp){
            if($motoImp instanceof MotoImportada === true){
                $coleccionMotosImp[] = $motoImp;
            }
        }

        return $coleccionMotosImp;
    }

    // Otras funciones
    public function mostrarArrayMotos(){
        // Recorre un arreglo de motos vendidas y las concatena 
        $coleccionMotos = $this->getArrayMoto();
        $moto_nro = 0;
        $unaCadenaDeMotos = "";

        for($i = 0; $i < count($coleccionMotos); $i++){
                $moto_nro++;
                $unaMoto = $coleccionMotos[$i];
                $unaCadenaDeMotos = $unaCadenaDeMotos . "Moto " . $moto_nro . ": \n" . $unaMoto . "\n";
        }

        return $unaCadenaDeMotos;

    }

}