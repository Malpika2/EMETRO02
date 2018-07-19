
<div class="lead"><strong>Registrar certificado</strong></div>
<hr />

 <form  method="post" name="formularioadd" id="formularioadd" action="<?php echo site_url('operaciones/registrarOperacion/'.$operador->idoperador);?>">
<table class="table-bordered table-striped">
  <tr valign="baseline">
    <th width="1">Operador:</th>
    <td><select readonly name="idoperador" class="form-control">
      <option value="<?php echo $operador->idoperador;?>" ><?php echo $operador->operador;?></option>
    </select></td>
  </tr>  
  <tr valign="baseline">
    <th nowrap="nowrap" align="right">Clave_certificado:</th>
    <td><input autofocus="autofocus" required="required" type="text" name="clave_operacion" value="<?php echo $operador->codigo_operador;?>-2017" class="form-control"/></td>
  </tr>
  <tr valign="baseline">
    <th nowrap="nowrap" align="right">Fecha_inspeccion:</th>
    <td><input type="date" name="fecha_inspeccion" value="" class="form-control"/></td>
  </tr>
  <tr valign="baseline">
    <th nowrap="nowrap" align="right">Fecha_emision:</th>
    <td><input type="date" name="fecha_emision" value="" class="form-control"/></td>
  </tr>
  <tr valign="baseline">
    <th nowrap="nowrap" align="right">Vigencia_inicio:</th>
    <td><input type="date" name="vigencia_inicio" value="" class="form-control"/></td>
  </tr>
  <tr valign="baseline">
    <th nowrap="nowrap" align="right">Vigencia_fin:</th>
    <td><input type="date" name="vigencia_fin" value="" class="form-control"/></td>
  </tr>
 <tr valign="baseline">
    <th nowrap="nowrap" align="right">Nombre_firma:</th>
    <td><input type="text" name="nombre_firma" value="" class="form-control"/></td>
  </tr>
  <tr valign="baseline">
    <th nowrap="nowrap" align="right">Cargo_firma:</th>
    <td><input type="text" name="cargo_firma" value="" class="form-control"/></td>
  </tr>
  <tr valign="baseline">
    <td nowrap="nowrap" align="right">&nbsp;</td>
    <td><input type="submit" value="Guardar" name="registrar" class="btn btn-primary" /></td>
  </tr>
</table>
<input type="hidden" name="MM_insert" value="form1" />
<input type="hidden" name="add" value="1" />
</form>