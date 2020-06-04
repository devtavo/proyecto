<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar ventas
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar ventas</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
        <a href="crear-venta">
          <button class="btn btn-primary" >
            Agregar venta 
          </button>
        </a>

        <button type="button" class="btn btn-default pull-right" id="daterange-btn">
          <span>
            <i class="fa fa-calendar"></i> Rango de Fecha
          </span>
          <i class="fa fa-caret-down"></i>
        </button>
      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Codigo factura</th>
           <th>Cliente</th>
           <th>Vendedor</th>
           <th>Forma de Pago</th>
           <th>Neto</th>
           <th>Total</th>
           <th>Fecha</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php
          if(isset($_GET["fechaInicial"])){

            $fechaInicial = $_GET["fechaInicial"];
            $fechaFinal = $_GET["fechaFinal"];
          }else{
            $fechaInicial = null;
            $fechaFinal = null;

          }

          $ventas = ControladorVentas::ctrRangoFechasVentas($fechaInicial, $fechaFinal);

          foreach ($ventas as $key => $value) {
           
            echo ' <tr>

                    <td>'.($key+1).'</td>

                    <td class="text-uppercase">'.$value["codigo"].'</td>';
                    
                    $itemCliente="id";
                    $valorCliente=$value["id_cliente"];

                    $respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

                    echo'<td class="text-uppercase">'.$respuestaCliente["nombre"].'</td>';
                    $itemUsuario="id";
                    $valorUsuario=$value["id_vendedor"];

                    $respuestaUsuario = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario);

                    echo'<td class="text-uppercase">'.$respuestaUsuario["nombre"].'</td>

                    <td class="text-uppercase">'.$value["metodo_pago"].'</td>

                    <td class="text-uppercase"> $'.number_format($value["neto"]).'</td>

                    <td class="text-uppercase"> $'.number_format($value["total"]).'</td>

                    <td class="text-uppercase">'.$value["fecha"].'</td>

                    <td>

                      <div class="btn-group">
                          
                        <button class="btn btn-info btnImprimirFactura" codigoVenta="'.$value["codigo"].'"><i class="fa fa-print"></i></button>

                        <button class="btn btn-warning btnEditarVenta" idVenta='.$value["id"].'"><i class="fa fa-pencil"></i></button>

                        <button class="btn btn-danger btnEliminarVenta" idVenta="'.$value["id"].'"><i class="fa fa-times"></i></button>

                      </div>  

                    </td>

                  </tr>';
          }

        ?>

        </tbody>

       </table>
       <?php
          $eliminarVenta= new ControladorVentas();
          $eliminarVenta -> ctrEliminarventa();
        ?>
      </div>

    </div>

  </section>

</div>




