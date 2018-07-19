<h4>Actualizar producto</h4>

<form action="<?php echo site_url('operaciones/actualizarOperacionProducto')?>" method="post" name="form1producto_add" id="form1producto_add">
<table class="table table-bordered table-striped">
      <tr class="info">
        <td>Nombre de producto*:</td>
        <td><input placeholder="Requerido" autofocus="autofocus" required="required" type="text" name="operacion_producto" value="<?php echo $operacion_producto->operacion_producto;?>" class="form-control"/></td>
      </tr>
      <tr class="info">
        <td>Catalogo SIAP:</td>
        <td>
        <select required name="idproducto" class="form-control">
        <option value="OTRO">OTRO</option>
        <?php foreach($producto as $row_producto){?>
        	<option <?php if($operacion_producto->idproducto == $row_producto->idproducto){?> selected="selected" <?php }?> value="<?php echo $row_producto->idproducto;?>"><?php echo $row_producto->producto_empresas_certificadoras.' '.$row_producto->variedad_empresas_certificadoras;?></option>
        <?php }?>
        </select>
        </td>
      </tr>
      
      <tr class="success">
        <td>Alcance*:</td>
        <td>
        <select required name="alcance" class="form-control">
        <option value="">Selecciona</option>
          <option <?php if($operacion_producto->alcance == 'PRODUCCION VEGETAL'){?> selected="selected" <?php }?> value="PRODUCCION VEGETAL">PRODUCCION VEGETAL</option>
          <option <?php if($operacion_producto->alcance == 'PRODUCCION ANIMAL'){?> selected="selected" <?php }?> value="PRODUCCION ANIMAL">PRODUCCION ANIMAL</option>
          <option <?php if($operacion_producto->alcance == 'RECOLECCION SILVESTRE'){?> selected="selected" <?php }?> value="RECOLECCION SILVESTRE">RECOLECCION SILVESTRE</option>
          <option <?php if($operacion_producto->alcance == 'PRODUCTOS PROCESADOS'){?> selected="selected" <?php }?> value="PRODUCTOS PROCESADOS">PRODUCTOS PROCESADOS</option>
          <option <?php if($operacion_producto->alcance == 'COMERCIALIZACION'){?> selected="selected" <?php }?> value="COMERCIALIZACION">COMERCIALIZACION</option>
        </select></td>
      </tr>
      
      <tr class="success">
        <td>Número de productores:</td>
        <td><input type="number" name="numero_productores" value="<?php echo $operacion_producto->numero_productores;?>" class="form-control"/></td>
      </tr>
      <tr class="info">
        <td>Descripción:</td>
        <td><textarea placeholder="Opcional, 200 Caracteres" name="descripcion" class="form-control"><?php echo $operacion_producto->descripcion;?></textarea></td>
      </tr>
      <tr><td colspan="2"><strong>Datos de producción</strong></td></tr>
      <tr class="info">
        <td>Produccion autorizada*:</td>
        <td><input type="number" step="any" name="produccion_autorizada" value="<?php echo $operacion_producto->produccion_autorizada;?>" class="form-control"/></td>
      </tr>
      <tr class="info">
        <td>Unidad de medida*:</td>
        <td>
        <select name="unidad_medida" class="form-control">
        <option value="">Selecciona</option>
        <?php foreach($unidad_medida1 as $row_unidad_medida1){?>
        	<option <?php if($operacion_producto->unidad_medida == $row_unidad_medida1->abreviacion){?> selected="selected" <?php }?> value="<?php echo $row_unidad_medida1->abreviacion;?>"><?php echo $row_unidad_medida1->unidad_medida;?></option>
        <?php }?>
        </select>
        </td>
      </tr>
      <tr><td colspan="2"><strong>Distribución de la producción</strong></td></tr>
      <tr class="success">
        <td>Cantidad*:</td>
        <td><input type="number" step="any" name="distribucion_cantidad" value="<?php echo $operacion_producto->distribucion_cantidad;?>" class="form-control"/></td>
      </tr>
      <tr class="success">
        <td>Unidad de medida*:</td>
        <td>
        <select name="distribucion_unidad" class="form-control">
        <option value="">Selecciona</option>
        <?php foreach($unidad_medida2  as $row_unidad_medida2){?>
        	<option <?php if($operacion_producto->distribucion_unidad == $row_unidad_medida2->abreviacion){?> selected="selected" <?php }?> value="<?php echo $row_unidad_medida2->abreviacion;?>"><?php echo $row_unidad_medida2->unidad_medida;?></option>
        <?php }?>
        </select>
        </td>
      </tr>
      <tr class="success">
        <td>Clasificación de unidad:</td>
        <td>
        <select name="clasificacion_unidad" class="form-control">
        <option value="">Selecciona</option>
        <option <?php if($operacion_producto->clasificacion_unidad == 'DEDICADA'){?> selected="selected" <?php }?> value="DEDICADA">DEDICADA</option>
        <option <?php if($operacion_producto->clasificacion_unidad == 'COMBINADA'){?> selected="selected" <?php }?> value="COMBINADA">COMBINADA</option>
        <option <?php if($operacion_producto->clasificacion_unidad == 'RECOLECCION SILVESTRE'){?> selected="selected" <?php }?> value="RECOLECCION SILVESTRE">RECOLECCION SILVESTRE</option>
        <option <?php if($operacion_producto->clasificacion_unidad == 'ENGORDA'){?> selected="selected" <?php }?> value="ENGORDA">ENGORDA</option>
        <option <?php if($operacion_producto->clasificacion_unidad == 'CARNE'){?> selected="selected" <?php }?> value="CARNE">CARNE</option>
        </select>
        </td>
      </tr>
      <tr><td colspan="2"><strong>Unidades productivas</strong></td></tr>
      <tr class="success">
        <td>Cantidad:</td>
        <td><input type="number" step="any" name="unidad_productiva_cantidad" value="<?php echo $operacion_producto->unidad_productiva_cantidad;?>" class="form-control"/></td>
      </tr>
      <tr class="success">
        <td>Unidad de medida:</td>
        <td>
        <select name="unidad_productiva_unidad" class="form-control">
        <option value="">Selecciona</option>
        <?php foreach($unidad_medida3 as $row_unidad_medida3){?>
        	<option <?php if($operacion_producto->unidad_productiva_unidad == $row_unidad_medida3->unidad_medida){?> selected="selected" <?php }?> value="<?php echo $row_unidad_medida3->unidad_medida;?>"><?php echo $row_unidad_medida3->unidad_medida;?></option>
        <?php }?>
        </select>
        </td>
      </tr>
      
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">&nbsp;</td>
        <td><input type="submit" name="actualizar" value="Guardar" class="btn btn-primary" /></td>
      </tr>
    </table>
    <input type="hidden" name="idoperacion" value="<?php echo $operacion->idoperacion; ?>" />
    <input type="hidden" name="idoperacion_producto" value="<?php echo $operacion_producto->idoperacion_producto;?>" />
    <input type="hidden" name="idoperador" value="<?php echo $operador->idoperador; ?>" />
    <input type="hidden" name="idorganismo_certificacion" value="14" />
  </form>