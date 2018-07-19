<?php 

class Operadores extends CI_Controller {
	
	public function  __construct(){
		parent::__construct();
		$this->load->model('operador','operador_model');
		$this->load->model('operacion','operacion_model');
		$this->load->model('operacion_producto','operacion_producto_model');
		$this->load->helper('url_helper');
	}
	
	public function registrar($categoria=null){
		
		$data['mensaje']=0;
		if($this->input->post('guardar')){
			if($this->guardar()){$data['mensaje']=1;}else{$data['mensaje']=2;}
		}
		$data['categoria'] = $categoria;
		$url_categoria = '';
		$url_action = '/insert_form';
		$url_categoria = 'main';
		switch($categoria){
			case 'agricola':
				$data['categoria'] = 'agricola';
				$data['string_categoria']="Producción vegetal";
				break;
			case 'ganaderia':
				$data['categoria'] = 'ganaderia';
				$data['string_categoria']="Producción animal";
				break;
			case 'procesador':
				$data['categoria'] = 'procesador';
				$data['string_categoria']="Procesamiento";
				break;
			case 'comercializador':
				$data['categoria'] = 'comercializador';
				$data['string_categoria']="Comercialización";
				break;
			
			default:
				$data['categoria'] = $categoria;
				$url_categoria = 'main';
			break;
		}		
		
		$this->load->view('admin/header');
			$this->load->view('admin/operador/menu',$data);
			$this->load->view('admin/operador/header');
				$this->load->view('admin/operador/'.$url_categoria.$url_action,$data);
			$this->load->view('admin/operador/footer');
		$this->load->view('admin/footer');
	}
	
	public function consultar($categoria=null){
		
		
		$this->load->model('operador','operador_model');
		$data['categoria'] = $categoria;
		
		$data['mensaje'] = 0;
		if($this->input->post('guardar')){
			if($this->guardar()){$data['mensaje']=1;}else{$data['mensaje']=2;}
		}
		
		$url_categoria = '';
		$url_action = '/view';
		
		switch($categoria){
			case 'agricola':
				$url_categoria = 'agricola';
				$data['string_categoria']="Producción vegetal";
				break;
			case 'ganaderia':
				$url_categoria = 'main';
				$data['string_categoria']="Producción animal";
				break;
			case 'procesador':
				$url_categoria = 'main';
				$data['string_categoria']="Procesamiento";
				break;
			case 'comercializador':
				$url_categoria = 'main';
				$data['string_categoria']="Comercialización";
				break;
				
			case 'export':
				$url_categoria = 'main';
				$url_action = '/view_export';
			break;
			
			default:
				$url_categoria = 'main';
				$data['string_categoria']="Sin categoria";
				$url_action = '/view_all';
			break;
		}		
		
		
		if($this->input->post('eliminarOperador')){
			$data['operadores'] = $this->operador_model->eliminarOperador($this->input->post('idoperador'));
			$data['mensaje']=3;
			
		}
		
		if(($this->input->post('buscar') or $this->input->post('busqueda'))){
			$data['operadores'] = $this->operador_model->get_operador_busqueda($categoria,$this->input->post('buscar'),$this->input->post('limite'));
			$data['main_active'] = 2;
		}else{
			$data['main_active'] = 2;
			$data['operadores'] = $this->operador_model->get_operador_busqueda($categoria,$this->input->post('buscar'),$this->input->post('limite'));

			///$data['operadores'] = $this->operador_model->get_all($categoria);
		}
		
		
		
		
		$this->load->view('admin/header');
			$this->load->view('admin/operador/menu',$data);
			$this->load->view('admin/operador/header');
				$this->load->view('admin/operador/'.$url_categoria.$url_action,$data);
			$this->load->view('admin/operador/footer');
		$this->load->view('admin/footer');
	}
	
	
	private $codigo_operador;
	private $actualizar_operacion;
	
	
	public function detalle($idoperador=null){

		$data['mensaje']=0;if($this->input->post('actualizar')){if($this->actualizar($idoperador)){$data['mensaje']=1;}else{$data['mensaje']=2;}}
		
		
		$operador = $this->operador_model->get_operador($idoperador);
		$data['operador'] = $operador;
		$this->codigo_operador = $operador->codigo_operador;
		
		
		//lateral derecho de vista
		if($this->input->post('registrar_operacion')){
			$vista_operaciones = 'operaciones/insert_form';
		}else if($this->actualizar_operacion==1){
			$data['value'] = $this->operacion_model->get_operacion_by_id($this->input->post('idoperacion'));
			$vista_operaciones = 'operaciones/update_form';
		}else{
			$total = $this->operacion_model->get_total_operacion_by_codigo_operador($this->codigo_operador);
			if($total > 0){
				$data['operacion'] = $this->operacion_model->get_operacion_by_codigo_operador($this->codigo_operador);
				$vista_operaciones = 'operaciones/oc_operadores_lista';
			}else{
				$vista_operaciones = 'operaciones/insert_form';
			}
		}
			
			
		
		$this->load->view('admin/header');
			$this->load->view('admin/operador/menu',$data);
			$this->load->view('admin/operador/header');
			
				$this->load->view('template/div_open');
					$this->load->view('admin/operador/main/update_form',$data);
				$this->load->view('template/div_close');
				$this->load->view('template/div_open');
					$this->load->view('operaciones/oc_operadores_submenu', $data);
					$this->load->view($vista_operaciones,$data);
				$this->load->view('template/div_close');
				
			$this->load->view('admin/operador/footer');
		$this->load->view('admin/footer');
	}
	
	
	public function guardar(){
		$this->load->model('operador','operador_model');
		$datos= array(
			'categoria'=> $this->input->post('categoria'),
			'operador'=> $this->input->post('operador'),
			'representante_legal'=> $this->input->post('representante_legal'),
			'nombre_huerta'=> $this->input->post('nombre_huerta'),
			'codigo_operador'=> $this->input->post('codigo_operador'),
			'tipo_persona'=> $this->input->post('tipo_persona'),
			'producto'=> $this->input->post('producto'),
			'rfc'=> $this->input->post('rfc'),
			'curp'=> $this->input->post('curp'),
			'calle'=> $this->input->post('calle'),
			'numero_exterior'=>  $this->input->post('numero_exterior'),
			'numero_interior'=> $this->input->post('numero_interior'),
			'colonia'=> $this->input->post('colonia'),
			'municipio'=> $this->input->post('municipio'),
			'localidad'=> $this->input->post('localidad'),
			'entidad_federativa'=> $this->input->post('entidad_federativa'),
			'pais'=> $this->input->post('pais'),
			'codigo_postal'=> $this->input->post('codigo_postal'),
			'web'=> $this->input->post('web'),
			'celular'=> $this->input->post('celular'),
			'telefono'=> $this->input->post('telefono'),
			'email'=> $this->input->post('email')
		);	
		return $this->operador_model->registrarOperador($datos);
	}
	
	public function actualizar($idoperador){
		$this->load->model('operador','operador_model');
		$datos= array(
			'categoria'=> $this->input->post('categoria'),
			'operador'=> $this->input->post('operador'),
			'representante_legal'=> $this->input->post('representante_legal'),
			'nombre_huerta'=> $this->input->post('nombre_huerta'),
			'codigo_operador'=> $this->input->post('codigo_operador'),
			'tipo_persona'=> $this->input->post('tipo_persona'),
			'producto'=> $this->input->post('producto'),
			'rfc'=> $this->input->post('rfc'),
			'curp'=> $this->input->post('curp'),
			'calle'=> $this->input->post('calle'),
			'numero_exterior'=>  $this->input->post('numero_exterior'),
			'numero_interior'=> $this->input->post('numero_interior'),
			'colonia'=> $this->input->post('colonia'),
			'municipio'=> $this->input->post('municipio'),
			'localidad'=> $this->input->post('localidad'),
			'entidad_federativa'=> $this->input->post('entidad_federativa'),
			'pais'=> $this->input->post('pais'),
			'codigo_postal'=> $this->input->post('codigo_postal'),
			'web'=> $this->input->post('web'),
			'telefono'=> $this->input->post('telefono'),
			'celular'=> $this->input->post('celular'),
			'email'=> $this->input->post('email')
		);	
		return $this->operador_model->actualizarOperador($datos,$idoperador);
	}
	
	
	public function index($categoria=null,$action=null){$this->consultar();}
	
	
		
		public function update_operacion($categoria,$idoperador){
		$this->load->model('operacion','operacion_model');
		if($this->input->post('guardar')){
			$datos= array(
				'clave_operacion'=> $this->input->post('clave_operacion'),
				'fecha_inspeccion'=> $this->input->post('fecha_inspeccion'),
				'fecha_emision'=> $this->input->post('fecha_emision'),
				'nombre_firma'=> $this->input->post('nombre_firma'),
				'cargo_firma'=> $this->input->post('cargo_firma"'),
				'vigencia_inicio'=> $this->input->post('vigencia_inicio'),
				'vigencia_fin'=> $this->input->post('vigencia_fin')
			);
			
			$id=$this->input->post('idoperacion');
			if($this->operacion_model->editarOperacion($datos,$id)==true){
				
				redirect("operadores/consultar/".$categoria."/".$id);

			
			}
		}//if guardar
	}
		
		
	public function sincronizar($idoperador=null){
	
	$data['mensaje']=0;if($this->input->post('actualizar')){if($this->actualizar($idoperador)){$data['mensaje']=1;}else{$data['mensaje']=2;}}
	
	
	$operador = $this->operador_model->get_operador($idoperador);
	$operacion = $this->operacion_model->get_operacion_by_id($this->input->post('idoperacion'));
	$operacion_productos = $this->operacion_producto_model->get_operacion_producto_by_idoperacion($this->input->post('idoperacion'));
	
	
	
	$data['operador'] = $operador;
	$this->codigo_operador = $operador->codigo_operador;	
	
	$vista_operaciones = 'operaciones/oc_operadores_lista';
	$mensaje_sincro = "Sync active.<br>";
	
	$this->load->model('sincro','sincro_model');
	
	$idoperador_remoto=0;

	if($this->sincro_model->operador_nuevo($operador->codigo_operador)){

		$mensaje_sincro .= "Operador nuevo.";
		$datos= array(
			'idorganismo_certificacion'=> 14,
			'operador'=> $operador->operador,
			'representante_legal'=> $operador->representante_legal,
			'clave_tercero'=> $operador->codigo_operador,
			'calle'=> $operador->calle,
			'numero_exterior'=>  $operador->numero_exterior,
			'numero_interior'=> $operador->numero_interior,
			'colonia'=> $operador->colonia,
			'municipio'=> $operador->municipio,
			'entidad_federativa'=> $operador->entidad_federativa,
			'codigo_postal'=> $operador->codigo_postal,
			'sitio_web'=> $operador->web,
			'telefono'=> $operador->telefono,
			'correo_electronico'=> $operador->email
		);	
		$idoperador_remoto = $this->sincro_model->registrarOperador($datos);

	}else{
		$datos= array(
			'idorganismo_certificacion'=> 14,
			'operador'=> $operador->operador,
			'representante_legal'=> $operador->representante_legal,
			'clave_tercero'=> $operador->codigo_operador,
			'calle'=> $operador->calle,
			'numero_exterior'=>  $operador->numero_exterior,
			'numero_interior'=> $operador->numero_interior,
			'colonia'=> $operador->colonia,
			'municipio'=> $operador->municipio,
			'entidad_federativa'=> $operador->entidad_federativa,
			'codigo_postal'=> $operador->codigo_postal,
			'sitio_web'=> $operador->web,
			'telefono'=> $operador->telefono,
			'correo_electronico'=> $operador->email
		);	
		$this->sincro_model->actualizarOperador($datos,$idoperador_remoto);
		
		$mensaje_sincro .= "Operador existente.<br>";
		$mensaje_sincro .= "<br>Clave operacion: ".$operacion->clave_operacion;
		$idoperador_remoto = $this->sincro_model->get_idoperador_remoto($operador->codigo_operador);

	}

	$operador_remoto = $this->sincro_model->get_operador_by_codigo_operador($operador->codigo_operador);
	$mensaje_sincro .= "<br>Codigo operador remoto: ".$operador_remoto->clave_tercero;
	$mensaje_sincro .= "<br><strong>ID operador SNPO</strong>: ".$idoperador_remoto;
	
	$operador_aux = $this->sincro_model->get_operador($operador->codigo_operador);
	
	//enviar operacion
		$datos= array(
		'idorganismo_certificacion' => 14,
		'idoperador' => $idoperador_remoto,
		'operador' => ($operacion->operador),
		'organismo_certificacion' => 'METROCERT',
		'calle' => ($operacion->calle),
		'numero_exterior' => ($operacion->numero_exterior),
		'numero_interior' => ($operacion->numero_interior),
		'colonia' => ($operacion->colonia),
		'municipio' => ($operacion->municipio),
		'entidad_federativa' => ($operacion->entidad_federativa),
		'codigo_postal' => ($operacion->codigo_postal),
		'telefono' => ($operacion->telefono),
		'correo_electronico' => ($operacion->correo_electronico),
		'sitio_web' => ($operacion->sitio_web),
		'clave_operador' => ($operacion->clave_operador),
		//datos de certificado / operacion
		'idoperador'=> $idoperador_remoto,
		'clave_operacion'=> $operacion->clave_operacion,
		'fecha_inspeccion'=> $operacion->fecha_inspeccion,
		'fecha_emision'=> $operacion->fecha_emision,
		'nombre_firma'=> $operacion->nombre_firma,
		'cargo_firma'=> $operacion->cargo_firma,
		'vigencia_inicio'=> $operacion->vigencia_inicio,
		'vigencia_fin'=> $operacion->vigencia_fin
		);

		$idoperacion = $this->sincro_model->registrarOperacion($datos);

		if($idoperacion){


			foreach ($operacion_productos as $row_operacion_producto) {
				$datos= array(
				'idoperacion'=> $idoperacion,
				'idoperador'=> $idoperador_remoto,
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
				$this->sincro_model->registrarOperacionProducto($datos);
				
				$mensaje_sincro .= "<br>Producto registrado: ".$row_operacion_producto->operacion_producto;
				
			}//fin foreach

		$datos= array(
		'sync'=> 'SI',
		'sync_fecha'=> time(),
		'sync_user'=> 'METROCERT.MX'
		);	
		
		$mensaje_sincro .= "<br>ID operacion: ".$this->input->post('idoperacion');

		$this->operacion_model->editarOperacion($datos,$this->input->post('idoperacion'));
		
		}
		
	$data['operacion'] = $this->operacion_model->get_operacion_by_codigo_operador($this->codigo_operador);
	
	
	
	
	$data['mensaje_sincro'] = $mensaje_sincro;
	
	
	$this->load->view('admin/header');
	$this->load->view('admin/operador/menu',$data);
	$this->load->view('admin/operador/header');
	
	$this->load->view('template/div_open');
	$this->load->view('admin/operador/main/sincro',$data);
	$this->load->view('template/div_close');
	$this->load->view('template/div_open');
	$this->load->view('operaciones/oc_operadores_submenu', $data);
	$this->load->view($vista_operaciones,$data);
	$this->load->view('template/div_close');
	
	$this->load->view('admin/operador/footer');
	$this->load->view('admin/footer');
	}//fin function sincronizar
		
		
		
		

		
		
}//class

