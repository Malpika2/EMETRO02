
	<ul class="nav nav-tabs">
  <li class="info">
  
  <form method="post" action="<?php echo site_url('operaciones/editar/'.$value->idoperacion); ?>">
    <input type="hidden"  name="idoperador" value="<?php echo $operador->idoperador; ?>"/>
    <button class="btn btn-info" name="idoperacion" value="<?php echo $value->idoperacion; ?>">
    	Productos
    </button>
    </form>
    
  </li>
  
	<li class="info">
  <form method="post" action="<?php echo site_url('operaciones/editar/'.$value->idoperacion); ?>">
  <input type="hidden"  name="idoperador" value="<?php echo $operador->idoperador; ?>"/>
  <input type="hidden" name="registrar_operacion_producto" value="1" />
    <button class="btn btn-info" name="idoperacion" value="<?php echo $value->idoperacion; ?>">
    	Registrar producto
    </button>
    </form>
  </li>
  
  
</ul>