
<?php 
    error_reporting(0);
    if(isset($_GET["fechaInicial"])){
        $fechaInicial = $_GET["fechaInicial"];
        $fechaFinal = $_GET["fechaFinal"];
    }else{
        $fechaInicial = null;
        $fechaFinal = null;
        }

    $ventas = ControladorVentas::ctrRangoFechasVentas($fechaInicial, $fechaFinal);
    foreach ($ventas as $key => $value) {
    }
    
?>
<!-- GRAFICO DE VENTAS -->
<div class="box box-solid bg-teal-gradient">
    <div class="box-header">
        <i class="fa fa-th"></i>
        <h3 class="box-title">Gráfico de ventas</h3>

    </div>
    <div class="box-body border-radius-none nuevoGraficoVentas">
        <div class="chart" id="line-chart-ventas" style="height:250px;"></div>
    </div>
</div>
<?php 
if(isset($_GET["fechaInicial"])){

    $fechaInicial = $_GET["fechaInicial"];
    $fechaFinal = $_GET["fechaFinal"];
  }else{
    $fechaInicial = null;
    $fechaFinal = null;

  }

  $ventas = ControladorVentas::ctrRangoFechasVentas($fechaInicial, $fechaFinal);
  $arrayFechas= array();
  $arrayVentas=array();
  $sumasPagosMes=array();
  foreach ($ventas as $key => $value) {
    $fecha= substr($value["fecha"],0,10);
    array_push($arrayFechas,$fecha);
    $ventas= $value["total"];
    $arrayVentas= array($fecha => $value["total"]);
    foreach ($arrayVentas as $key => $value) {
      $sumaPagosMes[$key]+=$value;
    }
    
  }
  $noRepetirFechas = array_unique($arrayFechas);
?>
<script>
    var line = new Morris.Line({
    element          : 'line-chart-ventas',
    resize           : true,
    data             : [

    <?php
    if($noRepetirFechas != null){
      foreach ($noRepetirFechas as $key) {

        echo "{ y: '".$key."', ventas: '".$sumaPagosMes[$key]."' },";
        }
        echo "{ y: '".$key."', ventas: '".$sumaPagosMes[$key]."' },";
    }else{
      echo "{y: '0', ventas: '0'}";
    }
    ?>
    ],
    xkey             : 'y',
    ykeys            : ['ventas'],
    labels           : ['ventas'],
    lineColors       : ['#efefef'],
    lineWidth        : 2,
    hideHover        : 'auto',
    gridTextColor    : '#fff',
    gridStrokeWidth  : 0.4,
    pointSize        : 4,
    pointStrokeColors: ['#efefef'],
    gridLineColor    : '#efefef',
    gridTextFamily   : 'Open Sans',
    preUnits         : '$',
    gridTextSize     : 10
  });
</script>