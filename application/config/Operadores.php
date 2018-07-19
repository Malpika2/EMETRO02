<?php 

class Operadores extends CI_Controller {
	
	public function  __construct(){
		parent::__construct();
		$this->load->helper('url_helper');
	}
	
	public function registrar($categoria=null){
		
		$data['mensaje']=0;
		if($this->input->post('guardar')){
			if($this->guardar()){$data['mensaje']=1;}else{$data['mensaje']=2;}
		}
		
		$url_categoria = '';
		$url_action = '/insert_form';
		
		switch($categoria){
			case 'agricola':$url_categoria = 'agricola';break;
			case 'ganaderia':$url_categoria = 'ganaderia';break;
			case 'procesador':$url_categoria = 'procesador';break;
			case 'comercializador':$url_categoria = 'comercializador';break;
			
			default:
				$url_categoria = 'main';
			break;
		}		
		
		$this->load->view('admin/header');
			$this->load->view('admin/operador/menu');
			$this->load->view('admin/operador/header');
				$this->load->view('admin/operador/'.$url_categoria.$url_action,$data);
			$this->load->view('admin/operador/footer');
		$this->load->view('admin/footer');
	}
	
	public function consultar($categoria=null){
		$this->load->model('operador','operador_model');
		
		$data['operadores'] = $this->operador_model->get_all();
		$data['mensaje'] = 0;
		if($this->input->post('guardar')){
			if($this->guardar()){$data['mensaje']=1;}else{$data['mensaje']=2;}
		}
		
		$url_categoria = '';
		$url_action = '/view';
		
		switch($categoria){
			case 'agricola':$url_categoria = 'agricola';break;
			case 'ganaderia':$url_categoria = 'ganaderia';break;
			case 'procesador':$url_categoria = 'procesador';break;
			case 'comercializador':$url_categoria = 'comercializador';break;
			
			default:
				$url_categoria = 'main';
			break;
		}		
		
		$this->load->view('admin/header');
			$this->load->view('admin/operador/menu');
			$this->load->view('admin/operador/header');
				$this->load->view('admin/operador/'.$url_categoria.$url_action,$data);
			$this->load->view('admin/operador/footer');
		$this->load->view('admin/footer');
	}
	
	public function guardar(){
		$this->load->model('operador','operador_model');
		
		$datos= array(
			'categoria'=> $this->input->post('categoria'),
			'operador'=> $this->input->post('operador'),
			'representante_legal'=> $this->input->post('representante_legal'),
			'codigo_operador'=> $this->input->post('codigo_operador'),
			'tipo_persona'=> $this->input->post('tipo_persona'),
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
			'telefono'=> $this->input->post('telefono'),
			'fax'=> $this->input->post('fax'),
			'email'=> $this->input->post('email')
		);
		
		
		return $this->operador_model->registrarOperador($datos);
		
	}
	
	public function index($categoria=null,$action=null){
				
		$this->consultar();
		/*
		$url_categoria = '';
		$url_action = '';
		
		switch($categoria){
			case 'agricola':$url_categoria = 'agricola';break;
			case 'ganaderia':$url_categoria = 'ganaderia';break;
			case 'procesador':$url_categoria = 'procesador';break;
			case 'comercializador':$url_categoria = 'comercializador';break;
			
			default:
				$url_categoria = 'main';
			break;
		}
		
		if($categoria){
			switch($action){
				case 'registrar':
					$url_action = $url_action.'/insert_form';
				break;
				case 'consultar':
					$url_action = $url_action.'/view';
				break;
				default:
					$url_categoria = 'main';$url_action = $url_action.'/view';
				break;
			}
		}
		
		$this->load->view('admin/header');
			$this->load->view('admin/operador/menu');
			$this->load->view('admin/operador/header');
				$this->load->view('admin/operador/'.$url_categoria.$url_action);
			$this->load->view('admin/operador/footer');
		$this->load->view('admin/footer');*/
	}
	
	
}
