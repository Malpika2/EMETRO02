<button class="btn btn-link icon-print" onclick="myFunction()">Imprimir</button>
<table align="center" class="table ">
<tr>
<td></td>
<td colspan="2"><h3>CERTIFICADO ORGÁNICO</h3></td>
</tr>
<tr>
<td align="center" valign="middle" width="300"><br />
<img src="<?php echo base_url('assets/images/distintivo_nacional.png'); ?>" width="150" />
</td>
<td>
<table border="0">
  <tr>
    <td>Operador:</td>
    <td><h4><?php echo $row_operacion->operador;?></h4></td>
  </tr>
  <tr>
    <td>Domicilio:</td>
    <td><?php echo $row_operador->calle." ".$row_operador->numero_exterior.", ".$row_operador->colonia." ".$row_operador->municipio.", ".$row_operador->entidad_federativa.".";?></td>
  </tr>
  <tr>
    <td>Representante legal:</td>
    <td><?php echo $row_operador->representante_legal;?></td>
  </tr>
  <tr>
    <td>ID Operador:</td>
    <td><strong><?php echo $row_operador->clave_tercero;?></strong></td>
  </tr>
  <tr>
    <td>ID Certificado:</td>
    <td><strong><?php echo $row_operacion->clave_operacion;?></strong></td>
  </tr>
</table>


</td>
<td align="center" valign="top" width="150">OC_LOGO</td>
</tr>
<tr>
<td colspan="3">
<strong>Productos, actividades cubiertas:</strong><br />

<table class="table table-bordered">
  <thead>
    <tr>
      <td>Alcance:</td>
      <td>Producto:</td>
      <td colspan="2">Produccion:</td>
      <td colspan="2">Distribución:</td>
      <td colspan="3">Unidad productiva:</td>
      <td>Productores</td>
    </tr>
    </thead>
    
    <tbody>
	<?php foreach ($operacion_producto as $row_operacion_producto) {?>
		<tr>
      <td><?php echo $row_operacion_producto->alcance;?></td>
      <td><?php echo $row_operacion_producto->operacion_producto;?></td>
      <td><?php if($row_operacion_producto->produccion_autorizada>0){echo number_format($row_operacion_producto->produccion_autorizada,2);}?></td>
      <td><?php echo $row_operacion_producto->unidad_medida;?></td>
      <td><?php if($row_operacion_producto->distribucion_cantidad>0){echo number_format($row_operacion_producto->distribucion_cantidad,2);}?></td>
      <td><?php echo $row_operacion_producto->distribucion_unidad;?></td>
      <td><?php echo $row_operacion_producto->unidad_productiva_cantidad;?></td>
      <td><?php echo $row_operacion_producto->unidad_productiva_unidad;?></td>
      <td><?php echo $row_operacion_producto->clasificacion_unidad;?></td>
      <td><?php echo $row_operacion_producto->numero_productores;?></td>
    </tr>
  <?php }?>
    </tbody>
    
  </table>
<strong>Localización:</strong>
<?php echo $row_operacion->calle." ".$row_operacion->numero_exterior.", ".$row_operacion->colonia." ".$row_operacion->municipio.", ".$row_operacion->entidad_federativa.".";?>
<br />
<strong>Representante legal:</strong> <?php echo $row_operador->representante_legal;?>
<br />
<strong>ID Operador Orgánico:</strong> <?php echo $row_operador->clave_tercero;?>
<h4><?php echo $row_operacion->clave_operador;?></h4>

</td>
</tr>
<tr>
<td colspan="3" align="justify">
Por medio del presente documento, y con fundamento en lo dispuesto en los artículos 17, 19, 22 y 23 de la Ley de Productos Orgánicos; 12, 15, 17 y 27 del Reglamento de la Ley de Productos Orgánicos; [OCO o SENASICA] certifica que el Operador, productos y actividades antes mencionadas, cumplen con las disposiciones y procedimientos señalados en el Acuerdo por el que se establecen los Lineamientos para la Operación Orgánica de las Actividades Agropecuarias. Es responsabilidad total del Operador cumplir permanentemente con las disposiciones y procedimientos correspondientes.
</td>
</tr>
<tr>
<td colspan="3" align="justify">
Este certificado no es válido como garantía para transacciones.
Para cada transacción comercial de producto Orgánico que ampara este certificado, [OCO o SENASICA] emite un Documento de Control/Transacción en el que se especifica la cantidad de producto a comercializar.
</td>
</tr>
<tr>
<td colspan="3" align="justify">

El presente Certificado Orgánico tiene validez de un año a partir de la fecha de emisión.
<hr />
<div class="col-lg-6">
<h5>Vigencia</h5>
Fecha de emisión:	<?php echo $row_operacion->fecha_emision;?>
<br />
Inicio:	<?php echo $row_operacion->vigencia_inicio;?>
<br />
Fin:		<?php echo $row_operacion->vigencia_fin;?>
</div>

<div class="col-lg-6">
<h5>Autorización</h5>
<strong><?php echo $row_operacion->nombre_firma;?></strong><br />
Cargo:  <?php echo $row_operacion->cargo_firma;?><br />
Organismo de certificación: <strong><?php echo $row_operacion->organismo_certificacion;?></strong>
</div>

</td>
</tr>
</table>

