<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Crear venta
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Crear venta</li>
    
    </ol>

  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-lg-5 col-xs-12">
        <div class="box box-success">
          <div class="box-header width-border"></div>

          <div class="box-body">
            <form role="form" method="post" class="formularioVenta">
              <div class="box">
              <?php
                    $item="id";
                    $valor=$_GET["idVenta"];
                    $venta=ControladorVentas::ctrMostrarVentas($item,$valor);

                    $itemUsuario="id";
                    $valorUsuario=$venta["id_vendedor"];
                    $vendedor=ControladorUsuarios::ctrMostrarUsuarios($itemUsuario,$valorUsuario);

                    $itemCliente="id";
                    $valorCliente=$venta["id_cliente"];
                    $cliente=ControladorClientes::ctrMostrarClientes($itemCliente,$valorCliente);
                    $porcentajeImpuesto = $venta["impuesto"] *  100 / $venta["neto"];
            ?>


                <!-- ENTRADA DEL VENDEDOR -->
                <div class="form-group">
                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" class="form-control" id="nuevoVendedor" value="<?php echo $vendedor["nombre"]; ?>" readonly>
                    <input type="hidden" name="idVendedor" value="<?php echo $vendedor["id"]; ?>">

                  </div>
                </div>
                <!-- ENTRADA DEL CODIGO -->
                <div class="form-group">
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>

                    <input type="text" class="form-control" id="editarVenta" name="editarVenta" value="<?php echo $venta["codigo"]; ?>" readonly>
                     
                  </div>
                </div>
                <!-- ENTRADA DEL CLIENTE -->
                <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-users"></i></span>
                      
                      <select class="form-control" name="seleccionarCliente" id="seleccionarCliente" readonly required>
                        <option value="<?php echo $cliente["id"] ?>"><?php echo  $cliente["nombre"] ?></option>
                      </select>
                      <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalAgregarCliente" data-dismiss="modal">Agregar cliente</button></span>
                    </div> 
                  </div>
                  <!-- ENTRADA PARA AGREGAR PRODUCTO -->
                  <div class="form-group row nuevoProducto">
                    <?php
                        $listaProducto = json_decode($venta["productos"],true);
                        foreach ($listaProducto as $key => $value) {
                            $item="id";
                            $valor=$value["id"];
                            $orden="id";
                            $respuesta=ControladorProductos::ctrMostrarProductos($item,$valor,$orden);

                            $stockAntiguo=$respuesta["stock"] + $value["cantidad"];
                            echo 
                        '<div class="row" style="padding:5px 15px">
					        <div class="col-xs-6" style="padding-right:0px">
                                <div class="input-group">
                                    <span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto ="'.$value["id"].'"><i class="fa fa-times"></i></button></span>
                                    <input type="text" class="form-control nuevaDescripcionProducto" name="agregarProducto" idProducto= "'.$value["id"].'" value="'.$value["descripcion"].'" readonly required>
                                </div>
					        </div>
					    <div class="col-xs-3 ingresoCantidad" >
						    <input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" nuevoStock = "'.$value["cantidad"].'" min="1" value="'.$value["cantidad"].'" stock="'.$stockAntiguo.'" required>
                        </div>
	
					    <div class="col-xs-3 ingresoPrecio" style="padding-left:0px">
						     <div class="input-group">
						        <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>	
						        <input type="text" class="form-control nuevoPrecioProducto" name="nuevoPrecioProducto" nuevoStock precioReal="'.$respuesta["precio_venta"].'" value="'.$value["total"].'" readonly required>
						     </div>
					    </div>
				    </div>';
                        }
                    ?>
                  </div>

                  <input type="hidden" name="listaProductos" id="listaProductos">
                  <!-- BOTON PARA AGREGAR PRODUCTO -->
                  <button type="button" class="btn btn-default hidden-lg btnAgregarProducto">Agregar productos</button>

                  <hr>
                  <div class="row">

                    <div class="col-xs-8 pull-right">

                      <table class="table">
                        <thead>

                          <tr>
                            <th>Impuesto</th>
                            <th>Total</th>
                          </tr>

                        </thead>
                        <tbody>

                          <tr>
                            <td style="width: 50%">
                              <div class="input-group">
                                <input type="number"min="0" name="nuevoImpuestoVenta" id="nuevoImpuestoVenta"  class="form-control" value="<?php echo $porcentajeImpuesto?>"required>
                                <input type="hidden" name="nuevoPrecioImpuesto" id="nuevoPrecioImpuesto"  value="<?php echo $venta["impuesto"]; ?>" required>

                                <input type="hidden" name="nuevoPrecioNeto" id="nuevoPrecioNeto" value="<?php echo $venta["neto"]; ?>" required>

                                <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                              </div>
                            </td>

                            <td style="width: 50%">
                              <div class="input-group">
                                <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                                <input type="text" name="nuevoTotalVenta" total="<?php echo $venta["neto"];?>" id="nuevoTotalVenta" class="form-control" value="<?php echo $venta["total"];?>" readonly required>
                                <input type="hidden" name="totalVenta" id="totalVenta" value="<?php echo $venta["neto"];?>">
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <hr>
                  <!-- ENTRADA DEL METODO DE PAGO -->
                  <div class="form-group row" >
                    <div class="col-xs-6">
                      <div class="input-group">
                        <select class="form-control" name="nuevoMetodoPago" id="nuevoMetodoPago"  required>
                          <option value="">Seleccione método de pago</option>
                          <option value="Efectivo">Efectivo</option>
                          <option value="TC">Tarjeta Crédito</option>
                          <option value="TD">Tarjeta Débito</option>
                        </select>
                      </div>
                    </div>
                    <div class="cajasMetodoPago"></div>
                    <input type="hidden" name="listaMetodoPago" id="listaMetodoPago">
                  </div>
                </div>
              </div>
              <br>
              <div class="box-footer">

                <button type="submit" class="btn btn-primary pull-right">Guardar cambios</button>
                
              </div>
            </form>

            <?php
            $editarVenta = new ControladorVentas();
            $editarVenta -> ctrEditarVenta(); 
            ?>
          </div>
        </div> 

      <!-- LA TABLA DE PRODUCTOS -->
      <div class="col-lg-7 hidden-md hidden-sm hidden-xs">
        <div class="box box-warning">
          <div class="box-header with-border"></div>
          <div class="box-body">
            <table class="table table-bordered table-stripped dt-responsive tablaVentas">
              <thead>
                <tr>
                  <th style="width:10px">#</th>
                  <th>Imagen</th>
                  <th>Código</th>
                  <th>Descripción</th>
                  <th>Stock</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>

              </tbody>

            </table>
          </div>
        </div>
      </div>

    </div>
  </section>
</div>

<!--=====================================
MODAL AGREGAR CLIENTE
======================================-->

<div id="modalAgregarCliente" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar cliente</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoCliente" placeholder="Ingresar nombre" required>

              </div>

            </div>

           <!-- ENTRADA PARA EL DOCUMENTO ID -->
            
           <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="number" min ="0" class="form-control input-lg" name="nuevoDocumentoId" placeholder="Ingresar documento" required>

              </div>

            </div>
          
           <!-- ENTRADA PARA EL EMAIL -->
            
           <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 

                <input type="email" class="form-control input-lg" name="nuevoEmail" placeholder="Ingresar email" required>

              </div>

            </div>

           <!-- ENTRADA PARA EL TELEFONO -->
            
           <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-phone"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoTelefono" placeholder="Ingresar teléfono" data-inputmask="'mask':'(999) 999-9999'" data-mask required>

              </div>

            </div>

          <!-- ENTRADA PARA EL DIRECCION -->
            
          <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaDireccion" placeholder="Ingresar Direccion" required>

            </div>

            </div>

          <!-- ENTRADA PARA FECHA DE NACIMIENTO  -->
            
          <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaFechaNacimiento" placeholder="Ingresar fecha nacimiento" data-inputmask="'alias' : 'yyyy/mm/dd'" data-mask required>

              </div>

          </div>
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar cliente</button>

        </div>

        <?php

          $crearCliente = new ControladorClientes();
          $crearCliente -> ctrCrearCliente();

        ?>

      </form>

    </div>

  </div>

</div>