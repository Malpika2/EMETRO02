<?php

class Operacion extends CI_Model {

				//listado inicio
				private $idoperacion;
				private $idoperador;
				private $idorganismo_certificacion;
				private $operador;
				private $organismo_certificacion;
				private $calle;
				private $numero_exterior;
				private $numero_interior;
				private $colonia;
				private $municipio;
				private $entidad_federativa;
				private $codigo_postal;
				private $telefono;
				private $correo_electronico;
				private $sitio_web;
				private $clave_operador;
				private $clave_operacion;
				private $clave_organismo_certificacion;
				private $fecha_inspeccion;
				private $fecha_emision;
				private $nombre_firma;
				private $cargo_firma;
				private $vigencia_inicio;
				private $vigencia_fin;
				private $procesamiento;
				private $comercializacion;


				//listado fin

				public function __construct()
        {
                parent::__construct();
								//$this->load->database();
								$this->db = $this->load->database('metrocert', TRUE);
        }

        public function get_all_operacion()
        {
					
                $query = $this->db->get('operacion');
                return $query->result();
        }
				
				public function get_list_operacion($numberListItems){
					$query = $this->db->query('SELECT 
					operacion.idoperacion, operacion.idoperador, organismo_certificacion, entidad_federativa, vigencia_inicio, vigencia_fin, clave_operacion, operador, operacion_producto from operacion, operacion_producto where operacion.idoperacion = operacion_producto.idoperacion group by idoperacion limit '.$numberListItems);				
					return $query->result();
					/*
          $this->db->select('*');
					$this->db->from('operacion');
					$this->db->order_by('idoperacion', 'DESC');
					$this->db->limit($numberListItems);
					$query = $this->db->get();
					return $query->result();*/
        }
				
				public function get_list_operacion_by_idorganismo_certificacion($idorganismo_certificacion,$numberListItems=25)
        {
					$this->db->select('*');
					$this->db->from('operacion');
					$this->db->where('idorganismo_certificacion', $idorganismo_certificacion);
					$this->db->order_by('idoperacion','desc');
					$this->db->limit($numberListItems);
					$query = $this->db->get();
					return $query->result();
        }
				
				public function get_total_operaciones_by_idorganismo_certificacion($idorganismo_certificacion)
        {
					$this->db->select('count(*) as total');
					$this->db->from('operacion');
					$this->db->where('idorganismo_certificacion', $idorganismo_certificacion);
					$query = $this->db->get();
					return $query->row()->total;
        }
				
				
				public function get_list_operacion_by_idorganismo_certificacion_full($idorganismo_certificacion){
					$query = $this->db->query("SELECT 
					alcance, operacion.idoperacion, operacion.idoperador, organismo_certificacion, clave_operador, entidad_federativa, vigencia_inicio, vigencia_fin, clave_operacion, operador, operacion_producto from operacion, operacion_producto where operacion.idoperacion = operacion_producto.idoperacion and operacion.idorganismo_certificacion = '".$idorganismo_certificacion."' group by idoperacion order by clave_operador asc");				
					return $query->result();
        }
				/*public function get_list_operacion_by_idorganismo_certificacion_full($idorganismo_certificacion)
        {
					$this->db->select('*');
					$this->db->from('operacion');
					$this->db->where('idorganismo_certificacion', $idorganismo_certificacion);
					$this->db->order_by('idoperacion','desc');
					$query = $this->db->get();
					return $query->result();
        }
				*/
				
				public function get_total_operaciones_por_entidad_federativa($numberListItems=10){
					$this->db->select('entidad_federativa, count(*) as total');
					$this->db->from('operacion');
					$this->db->group_by('entidad_federativa'); 
					$this->db->order_by('total', 'DESC');
					$this->db->limit($numberListItems);
					$query = $this->db->get();
					return $query->result();
				}
				
				public function get_total_operaciones_por_entidad_federativa_buscar($clave_operacion=NULL,$operador=NULL,$numberListItems=10){
					if(!$clave_operacion){
						if(!$operador){
							$where = false;
						}else{
							$where = "operador like '%$operador%'";
						}
					}else{
						if(!$operador){
							$where = "clave_operacion like '%$clave_operacion%'";
						}else{
							$where = "clave_operacion like '%$clave_operacion%' and operador like '%$operador%'";
						}
					}
					
					$this->db->select('entidad_federativa, count(*) as total');
					$this->db->from('operacion');
					
					if(strlen($where)>0){$this->db->where($where);}
					
					$this->db->group_by('entidad_federativa'); 
					$this->db->order_by('total', 'DESC');
					$this->db->limit($numberListItems);
					$query = $this->db->get();
					return $query->result();
				}
				
				public function get_operacion_by_id($idoperacion){
					$this->db->select('*');
					$this->db->from('operacion');
					$this->db->where('idoperacion', $idoperacion);
					$query = $this->db->get();
					return $query->row();
        }
				
				public function get_operacion_by_idoperador($idoperador){
					/*
					$query = $this->db->query('SELECT 
					operacion.idoperacion, operacion.idoperador, organismo_certificacion, entidad_federativa, fecha_emision, vigencia_inicio, vigencia_fin, clave_operacion, operador, count(operacion_producto.idoperacion_producto) as producto from operacion, operacion_producto where operacion.idoperador='.$idoperador.' group by operacion.idoperacion');				
					return $query->result();
					*/
					$this->db->distinct('*');
					$this->db->from('operacion');
					$this->db->where('idoperador', $idoperador);
					$this->db->order_by('idoperacion', 'DESC');
					$query = $this->db->get();
					
					return $query->result();
        }
				
				public function get_operacion_by_codigo_operador($codigo_operador){
					$this->db->distinct('*');
					$this->db->from('operacion');
					$this->db->where('clave_operador', $codigo_operador);
					$this->db->order_by('idoperacion', 'DESC');
					$query = $this->db->get();
					
					return $query->result();
        }
				
				public function get_total_operacion_by_idoperador($idoperador){
					$this->db->select('count(*) as total');
					$this->db->from('operacion');
					$this->db->where('idoperador', $idoperador);
					$query = $this->db->get();
					$result = $query->row();
					$total = $result->total;
					return $total;
        }
				
				public function get_total_operacion_by_codigo_operador($codigo_operador){
					$this->db->select('count(*) as total');
					$this->db->from('operacion');
					$this->db->where('clave_operador', $codigo_operador);
					$query = $this->db->get();
					$result = $query->row();
					$total = $result->total;
					return $total;
        }
				
				public function get_list_operacion_buscar($clave_operacion=NULL,$operador=NULL,$numberListItems=30){
					if(!$clave_operacion){
						if(!$operador){
							$where = false;
						}else{
							$where = "operador like '%$operador%'";
						}
					}else{
						if(!$operador){
							$where = "clave_operacion like '%$clave_operacion%'";
						}else{
							$where = "clave_operacion like '%$clave_operacion%' and operador like '%$operador%'";
						}
					}
					if(strlen($where)>0){$where = 'and '.$where;}
					$query = $this->db->query('SELECT 
					operacion.idoperacion, operacion.idoperador, organismo_certificacion, entidad_federativa, vigencia_inicio, vigencia_fin, clave_operacion, operador, operacion_producto from operacion, operacion_producto where operacion.idoperacion = operacion_producto.idoperacion '.$where.' group by idoperacion limit '.$numberListItems);				
					return $query->result();
					/*
					$this->db->select('SELECT * from operacion, operacion_producto');
					$this->db->from('operacion');
					$this->db->where($where);
					$this->db->order_by('idoperacion', 'DESC');
					$this->db->limit($numberListItems);
					$query = $this->db->get();
					$result_set = $query->result();
					*/
        }
				
		public function get_list_operacion_busqueda_avanzada($operador, $clave_operador, $clave_operacion, $producto, $entidad_federativa, $idorganismo_certificacion, $numberListItems=10){
	
			$where = false;
			
			if($operador){
				$whereoperador = "operador like '%$operador%'";
				$where = $where.' and '.$whereoperador;
			}
			if($clave_operador){
				$whereclave_operador = "clave_operador like '%$clave_operador%'";
				$where = $where.' and '.$whereclave_operador;
			}
			if($clave_operacion){
				$whereclave_operacion = "clave_operacion like '%$clave_operacion%'";
				$where = $where.' and '.$whereclave_operacion;
			}
			if($producto){
				$whereproducto = "operacion_producto like '%$producto%'";
				$where = $where.' and '.$whereproducto;
			}
			if($entidad_federativa){
				$whereentidad_federativa = "entidad_federativa like '%$entidad_federativa%'";
				$where = $where.' and '.$whereentidad_federativa;
			}
			if($idorganismo_certificacion){
				$whereidorganismo_certificacion = "operacion.idorganismo_certificacion like '%$idorganismo_certificacion%'";
				$where = $where.' and '.$whereidorganismo_certificacion;
			}
			
			$query = $this->db->query('SELECT 
			operacion.idoperacion, operacion.idoperador, organismo_certificacion, entidad_federativa, vigencia_inicio, vigencia_fin, clave_operador, clave_operacion, operador, operacion_producto from operacion, operacion_producto where operacion.idoperacion = operacion_producto.idoperacion '.$where.' group by idoperacion limit '.$numberListItems);				
			return $query->result();
		
		}
				
				
				public function get_total(){
					$query = $this->db->query('SELECT count(*) as total from operacion');				
					$result = $query->row();
					return $result->total;
					
				}
				
				
				public function get_total_operadores_por_organismo_certificacion(){
					$query = $this->db->query('SELECT nombre_corto as organismo_certificacion, count(operador) as total FROM organismo_certificacion, operador where organismo_certificacion.idorganismo_certificacion = operador.idorganismo_certificacion group by organismo_certificacion order by total desc');				
					return $query->result();
					
				}
				
				public function eliminarOperacion($idoperacion){
					if($this->db->query("delete from operacion_producto where idoperacion = '".$idoperacion."'")){
						if($this->db->query("delete from operacion where idoperacion = '".$idoperacion."' limit 1")){
							return true;
						}
					}else{
						return false;
					}
					
				}
				
        public function insert_operacion()
        {
        	//listado inicio
			$this->idoperacion = $this->input->post('idoperacion');
			$this->organismo_certificacion = $this->input->post('organismo_certificacion');
			$this->operador = $this->input->post('operador');
			$this->representante_legal = $this->input->post('representante_legal');
			$this->calle = $this->input->post('calle');
			$this->numero_exterior = $this->input->post('numero_exterior');
			$this->numero_interior = $this->input->post('numero_interior');
			$this->colonia = $this->input->post('colonia');
			$this->municipio = $this->input->post('municipio');
			$this->entidad_federativa = $this->input->post('entidad_federativa');
			$this->codigo_postal = $this->input->post('codigo_postal');
			$this->telefono = $this->input->post('telefono');
			$this->correo_electronico = $this->input->post('correo_electronico');
			$this->sitio_web = $this->input->post('sitio_web');
			$this->clave_tercero = $this->input->post('clave_tercero');
			$this->clave_oficial = $this->input->post('clave_oficial');
				
			//listado fin


             //$this->db->insert('NOMBRE_TABLA', $this);
             $this->db->insert('operacion', $this);
        }


		
		
		public function registrarOperacion($datos){
 	 $this->db->insert("operacion",$datos);
                   if ($this->db->affected_rows() > 0) {
                     return $this->db->insert_id();
                    }
                   else{
                      return false;
                    }
 }


	
public function editarOperacion($datos,$id){
	
	$this->db->where('idoperacion', $id);
	$this->db->update('operacion',$datos);
	if ($this->db->affected_rows() > 0) {
		return true;
	}
	else{
		return false;
	}
}

//metodos para estadisticas especificas por operador
	
	public function detalle_get_total_tabla($tabla,$idoperacion){
			$this->db->select('count(*) as total');
			$this->db->from($tabla);
			$this->db->where('idoperacion',$idoperacion); 
			$query = $this->db->get();
			return $query->row()->total;
		}

		public function detalle_get_total_superficie($idoperacion, $alcance = NULL){
			$where_alcance = '';
			if($alcance){
				$where_alcance = " and alcance = '".$alcance."'";
			}
			$query = $this->db->query("select sum(distribucion_cantidad) as total from operacion_producto where idoperacion='".$idoperacion."' and distribucion_unidad='HA' ".$where_alcance);
			return $query->row()->total;
		}
		
		public function detalle_get_total_productores($idoperacion, $alcance = NULL){
			$where_alcance = '';
			if($alcance){
				$where_alcance = " and alcance = '".$alcance."'";
			}
			$consulta = "select sum(numero_productores) as total from operacion_producto where idoperacion='".$idoperacion."' ".$where_alcance." group by idoperacion";
			$query = $this->db->query($consulta);
			if($query->result()){
				return $query->row()->total;
			}else{return 0;}
		}
		
		public function detalle_get_total_produccion($idoperacion, $alcance = NULL){
			$where_alcance = '';
			if($alcance){
				$where_alcance = " and alcance = '".$alcance."'";
			}
			
			$query = $this->db->query("select sum(produccion_autorizada) as total from operacion_producto where idoperacion='".$idoperacion."' and unidad_medida='TON' ".$where_alcance);
			$toneladas = $query->row()->total;
			
			$query = $this->db->query("select sum(produccion_autorizada) as total from operacion_producto where idoperacion='".$idoperacion."' and unidad_medida='KG' ".$where_alcance);
			$kilos = $query->row()->total;
			
			$total = $toneladas + ($kilos/1000);
						
			return $total;
			
		}//detalle
		
		
		
		
		


}//class