<?php

include_once 'Cliente.php';
include_once 'Moto.php';
include_once 'MotoNacional.php';
include_once 'MotoImportada.php';
include_once 'Venta.php';
include_once 'Empresa.php';

$objCliente1 = new Cliente("Pompon", "Pampa", false, "dni", 2255);
$objCliente2 = new Cliente("Guille", "Parmesano", false, "dni", 5522);
$objMoto1 = new MotoNacional(11, 2230000, 2022, "Benelli Imperiale 400", 85, true, 10);
$objMoto2 = new MotoNacional(12, 584000, 2021, "Zanella Zr 150", 70, true, 10);
$objMoto3 = new MotoNacional(13, 999900, 2023, "Zanella Patagonian Eagle 250", 55, false, 0);
$objMoto4 = new MotoImportada(14, 12499900, 2020, "Pitbike Enduro Motocross Apollo Aiii 190cc Plr", 100, true, "Francia", 6244400);
$objEmpresa = new Empresa("Alta Gama", "Av Argenetina 123", [$objCliente1, $objCliente2], [$objMoto1, $objMoto2, $objMoto3, $objMoto4], []);

// Punto 4
echo "Precio final de la venta: $" . $objEmpresa->registrarVenta([11, 12, 13, 14], $objCliente2) . "\n";

// echo "Moto 1: $" . $objMoto1->darPrecioVenta() . "\n";
// echo "Moto 2: $" . $objMoto2->darPrecioVenta() . "\n";
// echo "Moto 3: $" . $objMoto3->darPrecioVenta() . "\n";
// echo "Moto 4: $" . $objMoto4->darPrecioVenta() . "\n";

// Punto 5
echo "Precio final de la venta: $" . $objEmpresa->registrarVenta([13, 14], $objCliente2) . "\n";

// Punto 6
echo "Precio final de la venta: $" . $objEmpresa->registrarVenta([14, 2], $objCliente2) . "\n";

// Punto 7
print_r($objEmpresa->informarVentasImportadas());
echo "\n";

// Punto 8
echo "Sumatoria total de ventas nacionales: $" . $objEmpresa->informarSumaVentasNacionales() . "\n";

// Punto 9
echo $objEmpresa;