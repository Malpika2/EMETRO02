	<ul class="nav nav-tabs">
  <li class="">
  <form method="post" action="<?php echo site_url('operadores/detalle/'.$operador->idoperador); ?>">
  <button class="btn btn-info" name="codigo_operador" value="<?php echo $operador->codigo_operador; ?>">
  Certificados
  </button>
  </form>
  </li>
  <li>
  <form method="post" action="<?php echo site_url('operadores/detalle/'.$operador->idoperador); ?>">
  <input type="hidden" name="registrar_operacion" value="1" />
  <button class="btn btn-info" name="codigo_operador" value="<?php echo $operador->codigo_operador; ?>">
  Registrar certificado
  </button>
  </form>
  </li>
  </ul>
