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
  
<h4>COPIAR certificado</h4></div>
			<table align="center" class="table-bordered table-striped">
    <form method="post" action="<?php echo site_url('operaciones/copiarOperacion/'); ?><?php echo $operador->idoperador;?>">
    <input type="hidden" name="idoperacion_origen" value="<?php echo $idoperacion_origen;?>" />
      <tr valign="baseline">
    <th width="1">Operador:</th>
    <td><select readonly name="idoperador" class="form-control">
      <option value="<?php echo $operador->idoperador;?>" ><?php echo $operador->operador;?></option>
    </select></td>
  </tr> 
      <tr valign="baseline">
      <th nowrap="nowrap" align="right">Clave NUEVA:</th>
      <td><input autofocus="autofocus" required="required" type="text" name="clave_operacion" value="<?php echo $operador->codigo_operador;?>-2017" class="form-control"/></td>
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
           
          </td>
          <td>
          	<button class="btn btn-primary form-control" type="submit" name="guardar" value="1">COPIAR certificado</button>
          </td>
        </tr>
    </form>
    
      
      
    </table>