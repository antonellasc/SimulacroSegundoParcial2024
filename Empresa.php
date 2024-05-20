<?php

class Empresa{
    private $denominacion;
    private $direccion;
    private $arrayClientes;
    private $arrayMotos;
    private $arrayVentas;

    // Método constructor de la clase
    public function __construct($denomin_empresa, $domicilio, $colClientes, $colMotos, $colVentas){
        $this->denominacion = $denomin_empresa;
        $this->direccion = $domicilio;
        $this->arrayClientes = $colClientes;
        $this->arrayMotos = $colMotos;
        $this->arrayVentas = $colVentas;
    }

    // Métodos de acceso : GET
    public function getDenominacion(){
        return $this->denominacion;
    }

    public function getDireccion(){
        return $this->direccion;
    }

    public function getArrayClientes(){
        return $this->arrayClientes;
    }

    public function getArrayMotos(){
        return $this->arrayMotos;
    }

    public function getArrayVentas(){
        return $this->arrayVentas;
    }

    // Métodos de acceso : SET
    public function setDenominacion($denomin_empresa){
        $this->denominacion = $denomin_empresa;
    }

    public function setDireccion($domicilio){
        $this->direccion = $domicilio;
    }

    public function setArrayClientes($colClientes){
        $this->arrayClientes = $colClientes;
    }

    public function setArrayMotos($colMotos){
        $this->arrayMotos = $colMotos;
    }

    public function setArrayVentas($colVentas){
        $this->arrayVentas = $colVentas;
    }

    // Método to string
    public function __toString(){
        return "————————————————————————" . "\n Denominación: " . $this->getDenominacion() . "\n" . "Domicilio: " . $this->getDireccion() . "\n" . "Clientes: \n" . $this->mostrarClientes() . "\n" . 
        "Motos: \n" . $this->mostrarMotos() . "\n" . "Ventas: " . $this->mostrarVentas() . "\n";
    }

    // Funciones solicitadas por el enunciado
    public function retornarMoto($codigoMoto){
        // 5. Implementar el método retornarMoto($codigoMoto) que recorre la colección de motos de la Empresa y retorna la referencia al objeto moto
        //  cuyo código coincide con el recibido por parámetro.
        $coleccionMotos = $this->getArrayMotos();
        $motoRet = null;
        foreach($coleccionMotos as $moto){
            if($moto->getCodigo() === $codigoMoto){
                $motoRet = $moto;
            }
        }
        return $motoRet;

    }

    public function registrarVenta($colCodigosMoto, $objCliente){
        // 6. Implementar el método registrarVenta($colCodigosMoto, $objCliente) método que recibe por parámetro una colección de códigos de motos,
        // la cual es recorrida, y por cada elemento de la colección se busca el objeto moto correspondiente al código y
        // se incorpora a la colección de motos de la instancia Venta que debe ser creada. Recordar que no todos los clientes ni todas las motos,
        // están disponibles para registrar una venta en un momento determinado.
        // El método debe setear los variables instancias de venta que corresponda y retornar el importe final de la venta.
        // La clase venta tiene : un nro de venta, una fecha, el cliente al cual se le vende, el arreglo de motos vendidas, precio final(total) de la venta
        $colecVentas = $this->getArrayVentas();
        $ventaNro = count($colecVentas) + 1;
        $fechaVenta = date("d/m/y");
        $precioMoto = 0;
        $precioFinal = 0;
        $colecMotosVendidas = [];
        $motoDisponible = false; 
        $puedeComprar = $objCliente->getEstadoCliente();
        $i = 0;

        if($puedeComprar == false){
            // False significa que el cliente NO está dado de baja
            $objVenta = new Venta($ventaNro, $fechaVenta, $objCliente, $colecVentas, $precioFinal);
            while($i < count($colCodigosMoto)){
                $objMoto = $this->retornarMoto($colCodigosMoto[$i]);
                if($objMoto !== null){
                $motoDisponible = $objMoto->getDisponibilidad();
                $precioMoto = $objMoto->darPrecioVenta();
                $objVenta->incorporarMoto($objMoto);
                $precioFinal = $objVenta->getPrecioFinal();
                $colecMotosVendidas[] = $objMoto;

                // if ($motoDisponible == true){
                //     $precioFinal = $precioFinal + $precioMoto;
                //     $colecMotosVendidas[] = $objMoto;
                // }
            }
                $i++;
        }
    }
        if ($precioFinal > 0){
            $objVenta = new Venta($ventaNro, $fechaVenta, $objCliente, $colecMotosVendidas, $precioFinal);
            $colecVentas[] = $objVenta;
            $this->setArrayVentas($colecVentas);
        }
        return $precioFinal; 
    }

    public function retornarVentasXCliente($tipo, $nroDoc){
        // 7. Implementar el método retornarVentasXCliente($tipo,$numDoc) que recibe por parámetro el tipo y
        // número de documento de un Cliente y retorna una colección con las ventas realizadas al cliente
        $unCliente = null;
        $ventasUnCliente = [];
        $colClientes = $this->getArrayClientes();
        foreach($colClientes as $cliente){
            if($cliente->getTipoDoc() === $tipo && $cliente->getNroDoc() === $nroDoc){
                $unCliente = $cliente;
            }
        }
        if($unCliente !== null){
            $colDeVentas = $this->getArrayVentas();
            foreach($colDeVentas as $venta){
                if($venta->getObjCliente() === $unCliente){
                    $ventasUnCliente[] = $venta;
                }
            }
        }
        return $ventasUnCliente;
    }
    

    // Otras funciones
    public function mostrarClientes(){
        $arrClientes = $this->getArrayClientes();
        $cliente_n = 0;
        $cadenaClientes = "";
        for($i = 0; $i < count($arrClientes); $i++){
            $cliente_n++;
            $unCliente = $arrClientes[$i];
            $cadenaClientes = $cadenaClientes . "Cliente " . $cliente_n . ": \n" . $unCliente . "\n";
        }
        return $cadenaClientes;
    }

    public function mostrarMotos(){
        $arrMotos = $this->getArrayMotos();
        $moto_n = 0;
        $cadenaMotos = "";
        for($i = 0; $i < count($arrMotos); $i++){
            $moto_n++;
            $unaMoto = $arrMotos[$i];
            $cadenaMotos = $cadenaMotos . "Moto " . $moto_n . ": \n" . $unaMoto . "\n";
        }
        return $cadenaMotos;
    }

    public function mostrarVentas(){
        $arrVentas = $this->getArrayVentas();
        $venta_n = 0;
        $cadenaVentas = "";
        for($i = 0; $i < count($arrVentas); $i++){
            $venta_n++;
            $unaVenta = $arrVentas[$i];
            $cadenaVentas = $cadenaVentas . "Venta " . $venta_n . ": \n" . $unaVenta . "\n";
        }
        return $cadenaVentas;
    }

    // Métodos del 2do simulacro
    public function informarSumaVentasNacionales(){
        //recorre la colección de ventas realizadas por la empresa y retorna
        //el importe total de ventas Nacionales realizadas por la empresa
        $sumatoriaVentasNacionales = 0;
        $coleccionVentas = $this->getArrayVentas();
        foreach($coleccionVentas as $venta){
            $importeVenta = $venta->retornarTotalVentaNacional();
            $sumatoriaVentasNacionales = $sumatoriaVentasNacionales + $importeVenta;
        }
        return $sumatoriaVentasNacionales;
    }

    // 
    public function informarVentasImportadas(){
        // recorre la colección de ventas realizadas por la empresa y retorna
        // una colección de ventas de motos importadas. Si en la venta al menos
        //una de las motos es importada la venta debe ser informada
        $coleccionVentasImportadas = [];
        $coleccionVentas = $this->getArrayVentas();
        foreach($coleccionVentas as $venta){
            if($venta->retornarMotosImportadas() !== null){
                $coleccionVentasImportadas[] = $venta->retornarMotosImportadas();
            }
        }
        return $coleccionVentasImportadas;
    }
}