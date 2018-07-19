<?php

class Sincro extends CI_Model {

				
	private $db2;
	
	public function __construct()
	{
					parent::__construct();
					$this->load->database();
					$this->db2 = $this->load->database('sincro', TRUE);
	}
	
	
	public function operador_nuevo($codigo_operador)
	{
		$this->db2->select('count(*) as total');
		$this->db2->from('operador');
		$this->db2->where('clave_tercero', $codigo_operador);
		$query = $this->db2->get();
		$total = $query->row()->total;
		if($total==0){
			return true;
		}else{
			return false;
		}
	}
	
	public function get_operador($codigo_operador=null){
		$this->db2->from('operador');
		$this->db2->where('clave_tercero', $codigo_operador);
		$query = $this->db2->get();
		return $query->row();
	}
	
	public function get_idoperador_remoto($codigo_operador)
	{
		$this->db2->select('idoperador');
		$this->db2->from('operador');
		$this->db2->where('clave_tercero', $codigo_operador);
		$query = $this->db2->get();
		return $query->row()->idoperador;		
	}
	
	public function get_operador_by_codigo_operador($codigo_operador=null){
		$this->db2->from('operador');
		$this->db2->where('clave_tercero', $codigo_operador);
		$query = $this->db2->get();
		return $query->row();
	}
	
	public function registrarOperador($datos){
		$this->db2->insert("operador",$datos);
		if ($this->db2->affected_rows() > 0) {
			return $this->db2->insert_id();
		}
		else{
			return false;
		}
	}
	
	
	public function registrarOperacion($datos){
		$this->db2->insert("operacion",$datos);
		if ($this->db2->affected_rows() > 0) {
			return $this->db2->insert_id();
		}
		else{
			return false;
		}
	}
 
	public function registrarOperacionProducto($datos){
		$this->db2->insert("operacion_producto",$datos);
		if ($this->db2->affected_rows() > 0) {
			return $this->db2->insert_id();
		}
		else{
			return false;
		}
	}	
		
	
	public function actualizarOperador($datos,$idoperador){
		$this->db2->where('idoperador', $idoperador);
		$this->db2->update('operador',$datos);
		if ($this->db2->affected_rows() > 0) {
			return true;
		}
		else{
			return false;
		}
	}
		
		


}//class