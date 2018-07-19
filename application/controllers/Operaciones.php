<?php
class Operaciones extends CI_Controller {
	
	public function  __construct(){
		parent::__construct();
		$this->load->model('operador','operador_model');
		$this->load->model('operacion','operacion_model');
		$this->load->helper('url_helper');
	}
	
	public function registrarOperacion($idoperador){
	
		$row_operador = $this->operador_model->get_operador($this->input->post('idoperador'));
		
		$datos= array(
			'idorganismo_certificacion' => 14,
			'operador' => ($row_operador->operador),
			'organismo_certificacion' => 'METROCERT',
			'calle' => ($row_operador->calle),
			'numero_exterior' => ($row_operador->numero_exterior),
			'numero_interior' => ($row_operador->numero_interior),
			'colonia' => ($row_operador->colonia),
			'municipio' => ($row_operador->municipio),
			'entidad_federativa' => ($row_operador->entidad_federativa),
			'codigo_postal' => ($row_operador->codigo_postal),
			'telefono' => ($row_operador->telefono),
			'correo_electronico' => ($row_operador->email),
			'sitio_web' => ($row_operador->web),
			'clave_operador' => ($row_operador->codigo_operador),
			//datos de certificado / operacion
			'idoperador'=> $idoperador,
			'clave_operacion'=> $this->input->post('clave_operacion'),
			'fecha_inspeccion'=> $this->input->post('fecha_inspeccion'),
			'fecha_emision'=> $this->input->post('fecha_emision'),
			'nombre_firma'=> $this->input->post('nombre_firma'),
			'cargo_firma'=> $this->input->post('cargo_firma"'),
			'vigencia_inicio'=> $this->input->post('vigencia_inicio'),
			'vigencia_fin'=> $this->input->post('vigencia_fin')
		);
		
		$idoperacion = $this->operacion_model->registrarOperacion($datos);
		if($idoperacion){
			redirect('/operadores/detalle/'.$idoperador);
		}
		else{	
			redirect('/operadores/detalle/'.$idoperador);
		}
	}//fin function registrarOperacion
	
	private $mensaje;
	
	
	
	public function editar($idoperacion=null){
		
		if($this->idoperador){
			$idoperador = $this->idoperador;
		}else{
			$idoperador = $this->input->post('idoperador');
		}
		$operador = $this->operador_model->get_operador($idoperador);
		$data['operador'] = $operador;
		$data['mensaje'] = $this->mensaje;
		if($this->input->post('idoperacion')){
			$idoperacion = $this->input->post('idoperacion');
		}
		if($idoperacion){
			$data['idoperacion_origen'] = $idoperacion;
			//lateral derecho de vista
			if($this->input->post('registrar_operacion_producto')){
				$this->load->model('producto','producto_model');
				$this->load->model('unidad_medida','unidad_medida_model');
				$data['producto'] = $this->producto_model->get_all_producto();
				$data['unidad_medida1'] = $this->unidad_medida_model->get_lista_produccion();
				$data['unidad_medida2'] = $this->unidad_medida_model->get_lista_distribucion();
				$data['unidad_medida3'] = $this->unidad_medida_model->get_lista_unidades();
				$data['operacion'] = $this->operacion_model->get_operacion_by_id($idoperacion);
				$vista_operacion_productos = 'operacion_productos/insert_form';
				
			}else if($this->input->post('actualizar_operacion_producto')){
				
				if($this->input->post('idoperacion_producto')){
					$idoperacion_producto = $this->input->post('idoperacion_producto');
				}
				$this->load->model('producto','producto_model');
				$this->load->model('operacion_producto','operacion_producto_model');
				$this->load->model('unidad_medida','unidad_medida_model');
				$data['producto'] = $this->producto_model->get_all_producto();
				$data['unidad_medida1'] = $this->unidad_medida_model->get_lista_produccion();
				$data['unidad_medida2'] = $this->unidad_medida_model->get_lista_distribucion();
				$data['unidad_medida3'] = $this->unidad_medida_model->get_lista_unidades();
				$data['operacion_producto'] = $this->operacion_producto_model->get_operacion_producto_by_id($idoperacion_producto);
				$data['operacion'] = $this->operacion_model->get_operacion_by_id($idoperacion);
				$vista_operacion_productos = 'operacion_productos/update_form';
				
			}else{
				
				$this->load->model('operacion_producto','operacion_producto_model');
				$total = $this->operacion_producto_model->get_total_operacion_producto_by_idoperacion($idoperacion);
				if($total > 0){
					$data['operacion_producto'] = $this->operacion_producto_model->get_operacion_producto_by_idoperacion($idoperacion);
					$vista_operacion_productos = 'operacion_productos/oc_operaciones_lista';
				}else{
					$this->load->model('producto','producto_model');
				$this->load->model('unidad_medida','unidad_medida_model');
				$data['producto'] = $this->producto_model->get_all_producto();
				$data['unidad_medida1'] = $this->unidad_medida_model->get_lista_produccion();
				$data['unidad_medida2'] = $this->unidad_medida_model->get_lista_distribucion();
				$data['unidad_medida3'] = $this->unidad_medida_model->get_lista_unidades();
				$data['operacion'] = $this->operacion_model->get_operacion_by_id($idoperacion);
					
					$vista_operacion_productos = 'operacion_productos/insert_form';
				}
			}
			
			$data['heading'] = "Detalle de operacion";
			$data['value'] = $this->operacion_model->get_operacion_by_id($idoperacion);
			
			
			if($this->input->post('duplicar')){
				$vista_operacion = 'operaciones/copy_form';
			}else{
				$vista_operacion = 'operaciones/update_form';
			}
			
			//vistas
			$this->load->view('admin/header');
			$this->load->view('admin/operador/menu',$data);
			$this->load->view('admin/operador/header');
			
			$this->load->view('template/div_open');
				$this->load->view('operaciones/oc_operaciones_submenu', $data);
				$this->load->view($vista_operacion, $data);
			$this->load->view('template/div_close');
			$this->load->view('template/div_open');
				$this->load->view('operacion_productos/oc_operaciones_submenu', $data);
				$this->load->view($vista_operacion_productos);
			$this->load->view('template/div_close');
			
			$this->load->view('admin/operador/footer');
			$this->load->view('admin/footer');

			
			}else{
				redirect('/operadores/detalle/'.$idoperador);
			}	
				
	}//fin function editar
				

	
	private $idoperacion;
	private $idoperador;

	public function editarOperacion($idoperacion){
		
		if($this->input->post('guardar')){
			$datos= array(
			'clave_operacion'=> $this->input->post('clave_operacion'),
			'fecha_inspeccion'=> $this->input->post('fecha_inspeccion'),	
			'fecha_emision'=> $this->input->post('fecha_emision'),	
			'vigencia_inicio'=> $this->input->post('vigencia_inicio'),	
			'vigencia_fin'=> $this->input->post('vigencia_fin'),	
			'nombre_firma'=> $this->input->post('nombre_firma'),	
			'cargo_firma'=> $this->input->post('cargo_firma'));
			$id=$idoperacion;
			$this->operacion_model->editarOperacion($datos,$id);
			$this->mensaje=11;
			$this->editar($id);
			
		}//if guardar
	}	//fin function editarOperacion
	
	
	public function registrarOperacionProducto(){
		$this->load->model('operacion_producto','operacion_producto_model');
		$this->idoperador = $this->input->post('idoperador');
		//Comprobamos que el boton sea presionado
		if($this->input->post('registrar'))
		{
			$datos= array(
            'idoperacion'=> $this->input->post('idoperacion'),
            'idoperador'=> $this->input->post('idoperador'),
            'idorganismo_certificacion'=> 14,
           	'operacion_producto'=> $this->input->post('operacion_producto'),
           	'idproducto'=> $this->input->post('idproducto'),
           	'numero_productores'=> $this->input->post('numero_productores'),
           	'descripcion'=> $this->input->post('descripcion'),
           	'produccion_autorizada'=> $this->input->post('produccion_autorizada'),
            'unidad_medida'=> $this->input->post('unidad_medida'),
            'distribucion_cantidad'=> $this->input->post('distribucion_cantidad'),
            'distribucion_unidad'=> $this->input->post('distribucion_unidad'),
            'clasificacion_unidad'=> $this->input->post('clasificacion_unidad'),
            'unidad_productiva_cantidad'=> $this->input->post('unidad_productiva_cantidad'),
            'unidad_productiva_unidad'=> $this->input->post('unidad_productiva_unidad'),
            'alcance'=> $this->input->post('alcance')
            );
						if($this->operacion_producto_model->registrarOperacionProducto($datos)){
                 $this->editar($this->input->post('idoperacion'));
            }
            else{
               redirect("oc/operaciones/registrar");
            }
	}
}
	
	
	public function actualizarOperacionProducto(){
		$this->load->model('operacion_producto','operacion_producto_model');
		$this->idoperador = $this->input->post('idoperador');
		//Comprobamos que el boton sea presionado
		if($this->input->post('actualizar'))
		{
			$idoperacion_producto = $this->input->post('idoperacion_producto');
			
			$datos= array(
            'idoperacion'=> $this->input->post('idoperacion'),
            'idoperacion_producto'=> $this->input->post('idoperacion_producto'),
            'idoperador'=> $this->input->post('idoperador'),
            'idorganismo_certificacion'=> $this->input->post('idorganismo_certificacion'),
           	'operacion_producto'=> $this->input->post('operacion_producto'),
           	'idproducto'=> $this->input->post('idproducto'),
           	'numero_productores'=> $this->input->post('numero_productores'),
           	'descripcion'=> $this->input->post('descripcion'),
           	'produccion_autorizada'=> $this->input->post('produccion_autorizada'),
            'unidad_medida'=> $this->input->post('unidad_medida'),
            'distribucion_cantidad'=> $this->input->post('distribucion_cantidad'),
            'distribucion_unidad'=> $this->input->post('distribucion_unidad'),
            'clasificacion_unidad'=> $this->input->post('clasificacion_unidad'),
            'unidad_productiva_cantidad'=> $this->input->post('unidad_productiva_cantidad'),
            'unidad_productiva_unidad'=> $this->input->post('unidad_productiva_unidad'),
            'alcance'=> $this->input->post('alcance')
            );
						if($this->operacion_producto_model->editarOperacionProducto($datos,$idoperacion_producto)){
                 $this->editar($this->input->post('idoperacion'));
            }
            else{
							$this->editar();
            }
	}
}

	
	public function eliminarOperacion(){
		$this->idoperador = $this->input->post('idoperador');
		if($this->input->post('eliminar')){
			$id=$this->input->post('idoperacion');
			if($this->operacion_model->eliminarOperacion($id)){
				$this->mensaje = 'Operación eliminada correctamente.';
				//$this->index();
				redirect("/operadores/detalle/".$this->input->post('idoperador'));
			}
			else{
				$this->idoperacion = $id;
				$this->mensaje_error = 'Hubo un problema al eliminar los datos.';
				$this->editar($this->input->post('idoperacion'));
			}
		}//if guardar
	}	//fin function eliminarOperacion
	
	public function eliminarOperacionProducto(){
		$this->idoperador = $this->input->post('idoperador');
		$this->load->model('operacion_producto','operacion_producto_model');
		if($this->input->post('eliminarOperacionProducto')){
			$id=$this->input->post('idoperacion_producto');
			if($this->operacion_producto_model->eliminarOperacionProducto($id)){
				$this->mensaje = 'Producto eliminado correctamente.';
				$this->editar($this->input->post('idoperacion'));
			}
			else{
				$this->idoperacion = $id;
				$this->mensaje_error = 'Hubo un problema al eliminar los datos.';
				$this->editar($this->input->post('idoperacion'));
			}
		}//if guardar
	}	//fin function eliminarOperacion
	
	
	public function copiarOperacion($idoperador){
	
		$row_operador = $this->operador_model->get_operador($this->input->post('idoperador'));
		
		$datos= array(
			'idorganismo_certificacion' => 14,
			'operador' => ($row_operador->operador),
			'organismo_certificacion' => 'METROCERT',
			'calle' => ($row_operador->calle),
			'numero_exterior' => ($row_operador->numero_exterior),
			'numero_interior' => ($row_operador->numero_interior),
			'colonia' => ($row_operador->colonia),
			'municipio' => ($row_operador->municipio),
			'entidad_federativa' => ($row_operador->entidad_federativa),
			'codigo_postal' => ($row_operador->codigo_postal),
			'telefono' => ($row_operador->telefono),
			'correo_electronico' => ($row_operador->email),
			'sitio_web' => ($row_operador->web),
			'clave_operador' => ($row_operador->codigo_operador),
			//datos de certificado / operacion
			'idoperador'=> $idoperador,
			'clave_operacion'=> $this->input->post('clave_operacion'),
			'fecha_inspeccion'=> $this->input->post('fecha_inspeccion'),
			'fecha_emision'=> $this->input->post('fecha_emision'),
			'nombre_firma'=> $this->input->post('nombre_firma'),
			'cargo_firma'=> $this->input->post('cargo_firma"'),
			'vigencia_inicio'=> $this->input->post('vigencia_inicio'),
			'vigencia_fin'=> $this->input->post('vigencia_fin')
		);
		
		$idoperacion = $this->operacion_model->registrarOperacion($datos);
		if($idoperacion){
			
			$this->copiarOperacionProductos($this->input->post('idoperacion_origen'),$idoperacion,$idoperador);
			redirect('/operadores/detalle/'.$idoperador);
			
		}
		else{	
			redirect('/operadores/detalle/'.$idoperador);
		}
	}//fin function registrarOperacion
	
	public function copiarOperacionProductos($idoperacion_origen,$idoperacion_destino,$idoperador){
		
		$this->load->model('operacion_producto','operacion_producto_model');
		$total = $this->operacion_producto_model->get_total_operacion_producto_by_idoperacion($idoperacion_origen);
		if($total > 0){
			$operacion_producto = $this->operacion_producto_model->get_operacion_producto_by_idoperacion($idoperacion_origen);
			
			foreach ($operacion_producto as $row_operacion_producto) {
				$datos= array(
				'idoperacion'=> $idoperacion_destino,
				'idoperador'=> $idoperador,
				'idorganismo_certificacion'=> 14,
				'operacion_producto'=> $row_operacion_producto->operacion_producto,
				'idproducto'=> $row_operacion_producto->idproducto,
				'numero_productores'=> $row_operacion_producto->numero_productores,
				'descripcion'=> $row_operacion_producto->descripcion,
				'produccion_autorizada'=> $row_operacion_producto->produccion_autorizada,
				'unidad_medida'=> $row_operacion_producto->unidad_medida,
				'distribucion_cantidad'=> $row_operacion_producto->distribucion_cantidad,
				'distribucion_unidad'=> $row_operacion_producto->distribucion_unidad,
				'clasificacion_unidad'=> $row_operacion_producto->clasificacion_unidad,
				'unidad_productiva_cantidad'=> $row_operacion_producto->unidad_productiva_cantidad,
				'unidad_productiva_unidad'=> $row_operacion_producto->unidad_productiva_unidad,
				'alcance'=> $row_operacion_producto->alcance				);
				$this->operacion_producto_model->registrarOperacionProducto($datos);
			}//fin foreach
		}//fin if total
	}//fin function copiarOperacionProductos
	
	
	
	public function duplicarOperaciones(){
	$operaciones = $this->operacion_model->get_all_operacion();
	
		foreach ($operaciones as $row_operador) {
			echo 'operador: '.$row_operador->operador.'<br>';
			$datos= array(
				'idorganismo_certificacion' => ($row_operador->idorganismo_certificacion),
				'operador' => ($row_operador->operador),
				'organismo_certificacion' => 'METROCERT',
				'calle' => ($row_operador->calle),
				'numero_exterior' => ($row_operador->numero_exterior),
				'numero_interior' => ($row_operador->numero_interior),
				'colonia' => ($row_operador->colonia),
				'municipio' => ($row_operador->municipio),
				'entidad_federativa' => ($row_operador->entidad_federativa),
				'codigo_postal' => ($row_operador->codigo_postal),
				'telefono' => ($row_operador->telefono),
				'correo_electronico' => ($row_operador->correo_electronico),
				'sitio_web' => ($row_operador->sitio_web),
				'clave_operador' => ($row_operador->clave_operador),
				//datos de certificado / operacion
				'idoperador'=> $row_operador->idoperador,
				'clave_operacion'=> ($row_operador->clave_operador).'-2017',
				'fecha_inspeccion'=> $row_operador->fecha_inspeccion,
				'fecha_emision'=> $row_operador->fecha_emision,
				'nombre_firma'=> 'Mauricio Soberanes',
				'cargo_firma'=> 'Director General',
				'vigencia_inicio'=> $row_operador->vigencia_inicio,
				'vigencia_fin'=> $row_operador->vigencia_fin
			);
		
			$idoperacion = $this->operacion_model->registrarOperacion($datos);
			if($idoperacion){
				$this->copiarOperacionProductos($row_operador->idoperacion,$idoperacion,$row_operador->idoperador);
				//redirect('/operadores/detalle/'.$idoperador);
			}
			else{	
				//redirect('/operadores/detalle/'.$idoperador);
			}
		}//for each
	}//fin function registrarOperacion
	
	public function sincronizar($idoperador)
		{
			
			
			
			
			
			
			redirect('/operadores/detalle/'.$idoperador);
		}
	
}//fin class 
