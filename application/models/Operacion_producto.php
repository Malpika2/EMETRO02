<?php

class Operacion_producto extends CI_Model {

				public $idoperacion_producto;
				public $idoperacion;
				public $idoperador;
				public $idorganismo_certificacion;
				public $idsubporducto;
				public $operacion_producto;
				public $produccion_autorizada;
				public $unidad_medida;
				public $distribucion_cantidad;
				public $distribucion_unidad;
				public $unidad_productiva_cantidad;
				public $unidad_productiva_unidad;
				public $clasificacion_unidad;
				public $numero_productores;
				public $nombre_cientifico;
				public $alcance;
				
				public function __construct()
        {
                parent::__construct();
								//$this->load->database();
								$this->db = $this->load->database('metrocert', TRUE);
        }

        public function get_all_operacion_producto(){
                $query = $this->db->get('operacion_producto');
                return $query->result();
        }
				
				public function get_operacion_producto_by_idoperacion($idoperacion){
					$this->db->select('*');
					$this->db->from('operacion_producto');
					$this->db->where('idoperacion', $idoperacion);
					$query = $this->db->get();
					
					return $query->result();
        }
				
				public function get_cadena_operacion_producto_by_idoperacion($idoperacion, $alcance = NULL){
					$cadena = $alcance.': ';
					$cont_productos = 0;
					$this->db->select('operacion_producto');
					$this->db->from('operacion_producto');
					$this->db->where('idoperacion', $idoperacion);
					if($alcance){
						$this->db->where('alcance', $alcance);
					}
					$query = $this->db->get();
					$result_set = $query->result();
					
					foreach($result_set as $row_producto){
						$cont_productos++;
						if($cont_productos == 1){
							$cadena = $cadena.$row_producto->operacion_producto;
						}else{
							$cadena = $cadena.', '.$row_producto->operacion_producto;
						}
					}
					
					return ucwords($cadena);
        }
				
				public function get_operacion_producto_by_id($idoperacion_producto){
					$this->db->select('*');
					$this->db->from('operacion_producto');
					$this->db->where('idoperacion_producto', $idoperacion_producto);
					$query = $this->db->get();
					
					return $query->row();
        }
				
				public function get_total_operacion_producto_by_idoperacion($idoperacion, $alcance = NULL){
					$this->db->select('count(*) as total');
					$this->db->from('operacion_producto');
					$this->db->where('idoperacion', $idoperacion);
					if($alcance){
						$this->db->where('alcance', $alcance);
					}
					$query = $this->db->get();
					$result = $query->row();
					$total = $result->total;
					return $total;
        }
				
				
				public function get_total_productores(){
					$this->db->select('sum(numero_productores) as total');
					$this->db->from('operacion_producto');
					$query = $this->db->get();
					$result = $query->row();
					$total = $result->total;
					return $total;
        }
				
				public function get_total_hectareas(){
					$this->db->select('sum(distribucion_cantidad) as total');
					$this->db->from('operacion_producto');
					$this->db->where('distribucion_unidad', 'HA');
					$query = $this->db->get();
					$result = $query->row();
					$total = $result->total;
					return $total;
				}
				
				public function get_total_productos(){
					
					$query = $this->db->query('SELECT idproducto, count(*) as total FROM `operacion_producto` group by idproducto order by idproducto');				
					return $this->db->count_all_results(); 
					/*
					$this->db->select('count(*) as total');
					$this->db->from('operacion_producto');
					$this->db->group_by('idproducto');
					$query = $this->db->get();
					$result = $query->row();
					$total = $result->total;
					return $total;*/
        }
				

        public function insert_operacion_producto()
        {
			$this->idoperacion_producto = $this->input->post('idoperacion_producto');
			$this->idoperacion = $this->input->post('idoperacion');
			$this->idoperador = $this->input->post('idoperador');
			$this->idorganismo_certificacion = $this->input->post('idorganismo_certificacion');
			$this->idsubporducto = $this->input->post('idsubporducto');
			$this->operacion_producto = $this->input->post('operacion_producto');
			$this->produccion_autorizada = $this->input->post('produccion_autorizada');
			$this->unidad_medida = $this->input->post('unidad_medida');
			$this->distribucion_cantidad = $this->input->post('distribucion_cantidad');
			$this->distribucion_unidad = $this->input->post('distribucion_unidad');
			$this->nombre_cientifico = $this->input->post('nombre_cientifico');
			$this->alcance = $this->input->post('alcance');
			

                $this->db->insert('operacion_producto', $this);
        }

        public function update_operacion_producto(){
            $this->idoperacion_producto = $this->input->post('idoperacion_producto');
			$this->idoperacion = $this->input->post('idoperacion');
			$this->idoperador = $this->input->post('idoperador');
			$this->idorganismo_certificacion = $this->input->post('idorganismo_certificacion');
			$this->idsubporducto = $this->input->post('idsubporducto');
			$this->operacion_producto = $this->input->post('operacion_producto');
			$this->produccion_autorizada = $this->input->post('produccion_autorizada');
			$this->unidad_medida = $this->input->post('unidad_medida');
			$this->distribucion_cantidad = $this->input->post('distribucion_cantidad');
			$this->distribucion_unidad = $this->input->post('distribucion_unidad');
			$this->nombre_cientifico = $this->input->post('nombre_cientifico');
			$this->alcance = $this->input->post('alcance');

                $this->db->update('idoperacion_producto', $this, array('idoperacion_producto' => $this->input->post('idoperacion_producto')));
        }
				
				
				
				
				
		public function registrarOperacionProducto($datos){
			$this->db->insert("operacion_producto",$datos);
			if ($this->db->affected_rows() > 0) {
				return $this->db->insert_id();
			}
			else{
				return false;
			}
		}
		
		public function editarOperacionProducto($datos,$id){			
			$this->db->where('idoperacion_producto', $id);
			$this->db->update('operacion_producto',$datos);
			if ($this->db->affected_rows() > 0) {
				return true;
			}
			else{
				return false;
			}
		}
		
		public function eliminarOperacionProducto($idoperacion_producto){
			if($this->db->query("delete from operacion_producto where idoperacion_producto = '".$idoperacion_producto."' limit 1")){
				return true;
			}else{
				return false;
			}
			
		}
				

}