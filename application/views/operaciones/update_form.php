<?php if($mensaje==11){?>
<div class="alert alert-success" role="alert">
	<strong>Correcto!</strong> Los datos han sido actualizados correctamente.
</div>
<?php }else if($mensaje==22){?>
<div class="alert alert-danger" role="alert">
	<strong>Error!</strong> No se han actualizado tus datos.
</div>
<?php }?>


<div align="center"><a class="btn btn-info" href="<?php echo site_url('operadores/detalle/'); ?><?php echo $operador->idoperador;?>"><span class="fa fa-arrow-left fa-fw"></span>&nbsp;REGRESAR A CONSULTAR OPERADOR</a>
  
<h4>Actualizar certificado</h4></div>
			<table align="center" class="table-bordered table-striped">
    <form method="post" action="<?php echo site_url('operaciones/editarOperacion/'); ?><?php echo $value->idoperacion;?>">
      <tr valign="baseline">
    <th width="1">Operador:</th>
    <td><select readonly name="idoperador" class="form-control">
      <option value="<?php echo $operador->idoperador;?>" ><?php echo $operador->operador;?></option>
    </select></td>
  </tr> 
      <tr valign="baseline">
      <th nowrap="nowrap" align="right">Clave_certificado:</th>
      <td><input autofocus="autofocus" required="required" type="text" name="clave_operacion" value="<?php echo  $value->clave_operacion;?>" class="form-control"/></td>
      </tr>
      <tr valign="baseline">
        <th nowrap="nowrap" align="right">Fecha_inspeccion:</th>
        <td><input type="date" name="fecha_inspeccion" value="<?php echo  $value->fecha_inspeccion;?>" class="form-control"/></td>
      </tr>
      <tr valign="baseline">
        <th nowrap="nowrap" align="right">Fecha_emision:</th>
        <td><input type="date" name="fecha_emision" value="<?php echo  $value->fecha_emision;?>" class="form-control"/></td>
      </tr>
      <tr valign="baseline">
        <th nowrap="nowrap" align="right">Vigencia_inicio:</th>
        <td><input type="date" name="vigencia_inicio" value="<?php echo  $value->vigencia_inicio;?>" class="form-control"/></td>
      </tr>
      <tr valign="baseline">
        <th nowrap="nowrap" align="right">Vigencia_fin:</th>
        <td><input type="date" name="vigencia_fin" value="<?php echo  $value->vigencia_fin;?>" class="form-control"/></td>
      </tr>
      <tr valign="baseline">
        <th nowrap="nowrap" align="right">Nombre_firma:</th>
        <td><input type="text" name="nombre_firma" value="<?php echo  $value->nombre_firma;?>" class="form-control"/></td>
      </tr>
      <tr valign="baseline">
        <th nowrap="nowrap" align="right">Cargo_firma:</th>
        <td><input type="text" name="cargo_firma" value="<?php echo  $value->cargo_firma;?>" class="form-control"/></td>
      </tr>
        <tr valign="baseline">
          <td align="center">
           <a class="btn btn-success form-control disabled" target="_blank" href="<?php echo site_url('publico/certificados/consultar/'.$value->idoperacion.'/'.$value->idoperador); ?>">
              Ver certificado
            </a>
          </td>
          <td>
          	<button class="btn btn-primary form-control" type="submit" name="guardar" value="1">Actualizar certificado</button>
          </td>
        </tr>
    </form>
    
      <tr valign="baseline">
        <th></th>
        <td>
        <?php if(isset($_POST['activarEliminar'])){?>
        <form  method="post" action="<?php echo site_url('operaciones/eliminarOperacion')?>">
        <input type="hidden" name="idoperador" value="<?php echo $operador->idoperador; ?>" />
          <input type="hidden" name="idoperacion" value="<?php echo $value->idoperacion;?>"/>
          <button class="btn btn-danger form-control" type="submit" name="eliminar" value="1"><strong>CONFIRMAR</strong> Eliminar certificado</button>
        </form>
        <?php }else{?>
        <form method="post" action="<?php echo site_url('operaciones/editar/'.$value->idoperacion); ?>">
        <input type="hidden" name="idoperador" value="<?php echo $operador->idoperador; ?>" />
          <input type="hidden" name="idoperacion" value="<?php echo $value->idoperacion;?>"/>
          <input type="hidden" name="activarEliminar" value="1"/>
          <button class="btn btn-warning form-control" type="submit">Preparar para eliminar</button>
        </form>
        <?php }?>
        </td>
      </tr>
      
    </table>