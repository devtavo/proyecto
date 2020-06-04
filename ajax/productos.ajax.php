<?php
require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

class AjaxProductos{
    // CREAR CODIGO A PARTIR DE ID CATEGORIA
    public $idCategoria;
    
    public function ajaxCrearCodigoProducto(){
        $item="id_categoria";
        $valor=$this->idCategoria;
        $orden="id";
        $respuesta=ControladorProductos::ctrMostrarProductos($item,$valor,$orden);
        echo json_encode($respuesta);
    } 
    // EDITAR PRODUCTO
    public $idProducto;
    public $traerProductos;
    public $nombreProducto;

    public function ajaxEditarProducto(){
        if($this->traerProductos == "ok"){
            $item=null;
            $valor=null;
            $orden="id";
            $respuesta= ControladorProductos::ctrMostrarProductos($item,$valor,$orden);

            echo json_encode($respuesta);
        }else if($this->nombreProducto != ""){
            $item="descripcion";
            $valor=$this->nombreProducto;
            $orden="id";
            $respuesta= ControladorProductos::ctrMostrarProductos($item,$valor,$orden);

            echo json_encode($respuesta);
        }else{
            $item="id";
            $valor=$this->idProducto;
            $orden="id";
            $respuesta= ControladorProductos::ctrMostrarProductos($item,$valor,$orden);

            echo json_encode($respuesta);
        }
    }

}

    // CREAR CODIGO A PARTIR DE ID CATEGORIA
    if(isset($_POST["idCategoria"])){
        $codigoProducto= new AjaxProductos();
        $codigoProducto -> idCategoria = $_POST["idCategoria"];
        $codigoProducto -> ajaxCrearCodigoProducto();
    }

    // EDITAR PRODUCTO CON ID RECIBE
    if(isset($_POST["idProducto"])){
        $editarProducto= new AjaxProductos();
        $editarProducto -> idProducto = $_POST["idProducto"];
        $editarProducto -> ajaxEditarProducto();
    }

    // TRAER PRODUCTO CON ID RECIBE
    if(isset($_POST["traerProductos"])){
        $traerProductos= new AjaxProductos();
        $traerProductos -> traerProductos = $_POST["traerProductos"];
        $traerProductos -> ajaxEditarProducto();
    }

    // TRAER PRODUCTO PARA MOVILES
    if(isset($_POST["nombreProducto"])){
        $nombreProducto= new AjaxProductos();
        $nombreProducto -> nombreProducto = $_POST["nombreProducto"];
        $nombreProducto -> ajaxEditarProducto();
    }