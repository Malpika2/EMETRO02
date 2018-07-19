<div class="col-xs-4">

<div class="lead"><strong>Certificados registrados</strong></div>
<hr />
  <table class="table table-striped table-condensed table-bordered table-hover">
        <thead>
        <tr>
          <th colspan="2">Opciones</th>
          <th colspan="1">SNPO</th>
          <th colspan="2">Código certificado</th>
          <th>Vigencia</th>
          <th>Autorizó</th>
        </tr>
        </thead>
        <tbody>
        <?php $cont=0; foreach ($operacion as $row_operacion) { $cont++;?>
        <tr>
        <td>
        
    <form method="post" action="<?php echo site_url('operaciones/editar/'.$row_operacion->idoperacion); ?>">
    <input type="hidden" name="actualizar_operacion" value="1" />
    <button style="cursor:pointer" class="btn btn-warning" name="idoperador" value="<?php echo $operador->idoperador; ?>">
		<span class="fa fa-pencil fa-fw"></span> Editar
    </button>
    </form>
    
        </td>
        <td>
        
    <form method="post" action="<?php echo site_url('operaciones/editar/'.$row_operacion->idoperacion); ?>">
    <input type="hidden" name="duplicar" value="1" />
    <button style="cursor:pointer" class="btn btn-primary" name="idoperador" value="<?php echo $operador->idoperador; ?>">
		<span class="fa fa-file fa-fw"></span> Duplicar
    </button>
    </form>
    
        </td>
				<?php 
				if($row_operacion->sync=='SI'){
				?>
        <td class="alert alert-success">Sincronizado!<br />
        <?php 
				if($row_operacion->sync_fecha>2016){
				echo date('d-m-y',$row_operacion->sync_fecha);
				}?>
        </td>
				
				<?php }else{?>
				<td class="alert alert-danger">
        
<form method="post" action="<?php echo site_url('operadores/sincronizar/'.$operador->idoperador); ?>">
<input type="hidden" name="idoperacion" value="<?php echo $row_operacion->idoperacion; ?>" />
<button class="btn btn-danger" name="idoperador" value="<?php echo $operador->idoperador; ?>">
Sincronizar!
</button>
</form>
        
        </td>
				<?php }?>
			        
        <td width="1">
          <a class="btn btn-success disabled" target="_blank" href="<?php echo site_url('publico/certificados/consultar/'.$row_operacion->idoperacion.'/'.$row_operacion->idoperador); ?>">
            <span class="fa fa-file fa-fw" title="Ver Certificado"></span>
          </a>
        </td>
        
        <td><?php echo $row_operacion->clave_operacion; ?></td>
        <td><?php echo $row_operacion->vigencia_fin; ?></td>
        <td><?php echo $row_operacion->nombre_firma; ?></td>
        </tr>
        <?php } ?>
        <?php if($cont==0){?>
        <tr><td colspan="8" class="danger">No se encontraron registros</td></tr>
        <?php }?>
        </tbody>
        </table>
</div>