<div class="col-xs-12">
<table class="table table-sm table-striped table-hover table-bordered">
  <thead>
  <tr class="table-primary">
  	<th colspan="2">#</th>
    <th>Código</th>
    <th>Productor/empresa</th>
    <th>Rep_legal</th>
    <th>Huerta</th>
    <th><strong>CATEGORIA</strong></th>
    <th>Producto</th>
    <th>Teléfono</th>
    <th>Celular</th>
    <th>Email</th>
    <th></th>
  </tr>
  </thead>
  <?php 
	$cont = 0;
	if($main_active==2){
	foreach ($operadores as $operador){
		
		$categoria='';
		switch(strtoupper($operador->categoria)){
			case 'AGRICOLA':
				$categoria = 'PRODUCCIÓN VEGETAL';
			break;
			case 'GANADERIA':
				$categoria = 'PRODUCCIÓN ANIMAL';
			break;
			case 'PROCESADOR':
				$categoria = 'PROCESAMIENTO';
			break;
			case 'COMERCIALIZADOR':
				$categoria = 'COMERCIALIZACIÓN';
			break;
			default:
				$categoria = 'GENERAL';
			break;
		}
		
	$cont++;
	?>
  <tr>
  <td class="text-center" width="1">
    <?php if(!$categoria){$categoria='main';}?>
      <form method="post" action="<?php echo site_url('/operadores/detalle/'.$operador->idoperador);?>">
      <button style="cursor:pointer" class="btn btn-warning" type="submit" data-toggle="tooltip" data-placement="top" title="Actualizar" name="update" class="btn btn-danger"><i class="fa fa-wrench fa-fw"></i> Conf</button>
      <input type="hidden" name="idoperador" value="<?php echo $operador->idoperador;?>" />
      </form>
    </td>
  	<td><?php echo $cont;?></td>
    <td>
    	<?php echo $operador->codigo_operador;?>
    </td>
    <td>
    	<?php echo $operador->operador;?>
    </td>
    <td><?php echo $operador->representante_legal;?></td>
    <td>
    	<?php echo $operador->nombre_huerta;?>
    </td>
    <td>
    	<?php echo $categoria;?>
    </td>
    <td>
    	<?php echo strtoupper($operador->producto);?>
    </td>
    <td>
    	<?php echo $operador->telefono;?>
    </td>
    <td>
    	<?php echo $operador->celular;?>
    </td>
    <td>
    	<?php echo $operador->email;?>
    </td>
    
    <td class="text-center" width="1">
    <?php if(!$categoria){$categoria='main';}?>
		<?php if(isset($_POST['activarEliminar'])&&$_POST['idoperador']==$operador->idoperador){?>
    <form method="post" action="<?php echo site_url('/operadores/consultar/');?>">
    <?php if(isset($_POST['buscar'])){?>
    <input type="hidden" name="buscar" value="<?php echo $_POST['buscar']?>" />
		<?php }?>
    <button style="cursor:pointer" class="btn btn-danger " type="submit" data-toggle="tooltip" data-placement="top" title="Eliminar" name="update" class="btn btn-danger"><i class="fa fa-remove fa-fw"></i></button>
    <input type="hidden" name="idoperador" value="<?php echo $operador->idoperador;?>" />
    <input type="hidden" name="eliminarOperador" value="true" />
    </form>
    <?php }else{?>
    <form method="post" action="<?php echo site_url('/operadores/consultar/');?>">
    <?php if(isset($_POST['buscar'])){?>
    <input type="hidden" name="buscar" value="<?php echo $_POST['buscar']?>" />
		<?php }?>
    <input type="hidden" name="idoperador" value="<?php echo $operador->idoperador; ?>" />
    <input type="hidden" name="activarEliminar" value="1"/>
    <button class="btn btn-warning form-control" type="submit">Eliminar</button>
    </form>
    <?php }?>
    </td>
    
  </tr>
  <?php }}?>
</table>
<div class="">
  <?php if (isset($links)) {
          echo $links;
        }  ?>
</div>
</div>