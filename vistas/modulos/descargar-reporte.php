<?php
require "../../controladores/ventas.controlador.php";
require "../../modelos/ventas.modelo.php";
require "../../controladores/clientes.controlador.php";
require "../../modelos/clientes.modelo.php";
require "../../controladores/usuarios.controlador.php";
require "../../modelos/usuarios.modelo.php";

$reporte= new ControladorVentas();
$reporte -> ctrDescargarReporte();
