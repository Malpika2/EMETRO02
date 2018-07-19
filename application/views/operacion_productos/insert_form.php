<h4>Registrar producto</h4>

<form action="<?php echo site_url('operaciones/registrarOperacionProducto')?>" method="post" name="form1producto_add" id="form1producto_add">
<table class="table table-bordered table-striped">
      <tr class="info">
        <td>Nombre de producto*:</td>
        <td><input placeholder="Requerido" autofocus="autofocus" required="required" type="text" name="operacion_producto" value="" class="form-control"/></td>
      </tr>
      <tr class="info">
        <td>Catalogo SIAP:</td>
        <td>
        <select required name="idproducto" class="form-control">
        <option value="OTRO">OTRO</option>
        <?php foreach($producto as $row_producto){?>
        	<option value="<?php echo $row_producto->idproducto;?>"><?php echo $row_producto->producto_empresas_certificadoras.' '.$row_producto->variedad_empresas_certificadoras;?></option>
        <?php }?>
        </select>
        </td>
      </tr>
      
      <tr class="success">
        <td>Alcance*:</td>
        <td>
        <select required name="alcance" class="form-control">
          <option value="PRODUCCION VEGETAL">PRODUCCION VEGETAL</option>
          <option value="PRODUCCION ANIMAL">PRODUCCION ANIMAL</option>
          <option value="RECOLECCION SILVESTRE">RECOLECCION SILVESTRE</option>
          <option value="PRODUCTOS PROCESADOS">PRODUCTOS PROCESADOS</option>
          <option value="COMERCIALIZACION">COMERCIALIZACION</option>
        </select></td>
      </tr>
      
      <tr class="success">
        <td>Número de productores:</td>
        <td><input type="number" name="numero_productores" value="" class="form-control"/></td>
      </tr>
      <tr class="info">
        <td>Descripción:</td>
        <td><textarea placeholder="Opcional, 200 Caracteres" name="descripcion" class="form-control"></textarea></td>
      </tr>
      <tr><td colspan="2"><strong>Datos de producción</strong></td></tr>
      <tr class="info">
        <td>Produccion autorizada*:</td>
        <td><input type="number" step="any" name="produccion_autorizada" value="" class="form-control"/></td>
      </tr>
      <tr class="info">
        <td>Unidad de medida*:</td>
        <td>
        <select name="unidad_medida" class="form-control">
        <option value="">Selecciona</option>
        <?php foreach($unidad_medida1 as $row_unidad_medida1){?>
        	<option value="<?php echo $row_unidad_medida1->abreviacion;?>"><?php echo $row_unidad_medida1->unidad_medida;?></option>
        <?php }?>
        </select>
        </td>
      </tr>
      <tr><td colspan="2"><strong>Distribución de la producción</strong></td></tr>
      <tr class="success">
        <td>Cantidad*:</td>
        <td><input type="number" step="any" name="distribucion_cantidad" value="" class="form-control"/></td>
      </tr>
      <tr class="success">
        <td>Unidad de medida*:</td>
        <td>
        <select name="distribucion_unidad" class="form-control">
        <option value="">Selecciona</option>
        <?php foreach($unidad_medida2  as $row_unidad_medida2){?>
        	<option value="<?php echo $row_unidad_medida2->abreviacion;?>"><?php echo $row_unidad_medida2->unidad_medida;?></option>
        <?php }?>
        </select>
        </td>
      </tr>
      <tr class="success">
        <td>Clasificación de unidad:</td>
        <td>
        <select name="clasificacion_unidad" class="form-control">
        <option value="">Selecciona</option>
        <option value="DEDICADA">DEDICADA</option>
        <option value="RECOLECCION SILVESTRE">RECOLECCION SILVESTRE</option>
        <option value="ENGORDA">ENGORDA</option>
        <option value="CARNE">CARNE</option>
        </select>
        </td>
      </tr>
      <tr>
        <td colspan="2"><strong>Unidades productivas</strong></td></tr>
      <tr class="success">
        <td>Cantidad:</td>
        <td><input type="number" step="any" name="unidad_productiva_cantidad" value="" class="form-control"/></td>
      </tr>
      <tr class="success">
        <td>Unidad de medida:</td>
        <td>
        <select name="unidad_productiva_unidad" class="form-control">
        <option value="">Selecciona</option>
        <?php foreach($unidad_medida3 as $row_unidad_medida3){?>
        	<option value="<?php echo $row_unidad_medida3->unidad_medida;?>"><?php echo $row_unidad_medida3->unidad_medida;?></option>
        <?php }?>
        </select>
        </td>
      </tr>
      
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">&nbsp;</td>
        <td><input type="submit" name="registrar" value="Guardar" class="btn btn-primary" /></td>
      </tr>
    </table>
    <input type="hidden"  name="idoperador" value="<?php echo $operador->idoperador; ?>"/>
    <input type="hidden" name="idoperacion" value="<?php echo $operacion->idoperacion; ?>" />
    <input type="hidden" name="idorganismo_certificacion" value="14" />
  </form>