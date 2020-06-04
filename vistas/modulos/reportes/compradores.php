<?php
$item=null;
$valor=null;

$ventas=ControladorVentas::ctrMostrarVentas($item,$valor);
$clientes=ControladorClientes::ctrMostrarClientes($item,$valor);
$arrayClientes=array();
$arrayListaClientes=array();
foreach ($ventas as $key => $valueVentas) {
    foreach ($clientes as $key => $valueClientes) {
        if($valueClientes["id"] == $valueVentas["id_cliente"]){
            //Capturamos a los vendedores en un array
            array_push($arrayClientes, $valueClientes["nombre"]);

            //Capturamos los nombres y los valores netos en el mismo array 
            $arrayListaClientes=array($valueClientes["nombre"]=> $valueVentas["neto"]);

            //SUMAMOS LOS NETOS DEL CLIENTE
            foreach ($arrayListaClientes as $key => $value) {
                $sumaTotalClientes[$key] +=$value;
            }   
        }
    }
}

$noRepetirNombres= array_unique($arrayClientes);


?>
<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">Compradores</h3>
    
    </div>
    <div class="box-body">
        <div class="chart" id="bar-chart2" style="height: 300px;"></div>
    </div>
</div>

<script>
//BAR CHART
var bar = new Morris.Bar({
    element: 'bar-chart2',
    resize: true,
    data: [
        <?php
    foreach ($noRepetirNombres as  $value) {
        echo "{y: ' ".$value." ', a: ".$sumaTotalClientes[$value]."},";
    }
    ?>
    ],
    barColors: ['#f6a'],
    xkey: 'y',
    ykeys: ['a'],
    labels: ['ventas'],
    preUnits: '$',
    hideHover: 'auto'
});
</script>