<h4>Productos registrados</h4>
<?php if($mensaje==3){?>
<div class="alert alert-success" role="alert">
<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
<span class="sr-only">Error:</span>
<?php echo $mensaje;?>
</div>
<?php }?>
  <table class="table table-striped table-condensed table-bordered table-hover">
  <thead>
    <tr>
      <td colspan="3">Producto</td>
    </tr>
  </thead>
  <tbody>
  <?php $cont=0; foreach ($operacion_producto as $row_operacion_producto) { $cont++;?>
    <tr>
      <td >
      <form method="post" action="<?php echo site_url('operaciones/editar/'); ?>">
  <input type="hidden" name="actualizar_operacion_producto" value="1" />
  <input type="hidden" name="idoperador" value="<?php echo $operador->idoperador; ?>" />
  <input type="hidden" name="idoperacion_producto" value="<?php echo $row_operacion_producto->idoperacion_producto; ?>" />
  
    <button class="btn btn-warning  fa fa-edit fa-fw" name="idoperacion" value="<?php echo $value->idoperacion; ?>"></button>
    </form>
    
      
      </td>
      <td><strong><?php echo $row_operacion_producto->operacion_producto; ?></strong><br />
			Productores:<?php echo $row_operacion_producto->numero_productores; ?></td>
      <td>
        <strong><?php echo $row_operacion_producto->alcance; ?></strong>
      	<table>
      	  <tr>
      	<td colspan="2">Producción</td>
        <td><?php if($row_operacion_producto->produccion_autorizada>0){echo number_format($row_operacion_producto->produccion_autorizada,2);} ?></td>
        <td><?php echo $row_operacion_producto->unidad_medida; ?></td>
        </tr>
        <tr>
        <td colspan="2">Distribución</td>
        <td><?php if($row_operacion_producto->distribucion_cantidad>0){echo number_format($row_operacion_producto->distribucion_cantidad,2);} ?></td>
        <td><?php echo $row_operacion_producto->distribucion_unidad.' '.$row_operacion_producto->clasificacion_unidad; ?></td>
      	</tr>
      </table>
      </td>
      <td>
      <?php if(isset($_POST['activarEliminarProducto'])and $_POST['idoperacion_producto']==$row_operacion_producto->idoperacion_producto){?>
      <form  method="post" action="<?php echo site_url('operaciones/eliminarOperacionProducto')?>">
      <input type="hidden" name="idoperador" value="<?php echo $operador->idoperador; ?>" />
      	<input type="hidden" name="idoperacion_producto" value="<?php echo $row_operacion_producto->idoperacion_producto; ?>" />
        <input type="hidden" name="idoperacion" value="<?php echo $value->idoperacion;?>"/>
        <button class="btn btn-danger " type="submit" name="eliminarOperacionProducto" value="1"><strong>CONFIRMAR</strong></button>
      </form>
      <?php }else{?>
      
      <form method="post" action="<?php echo site_url('operaciones/editar/'.$value->idoperacion); ?>">
      <input type="hidden" name="idoperador" value="<?php echo $operador->idoperador; ?>" />
      	<input type="hidden" name="idoperacion_producto" value="<?php echo $row_operacion_producto->idoperacion_producto; ?>" />
        <input type="hidden" name="idoperacion" value="<?php echo $value->idoperacion;?>"/>
        <input type="hidden" name="activarEliminarProducto" value="1"/>
        <button class="btn btn-warning " type="submit">Eliminar</button>
      </form>
      <?php }?>
      </td>
    </tr>
    <?php }  ?>
  </tbody>
</table>
