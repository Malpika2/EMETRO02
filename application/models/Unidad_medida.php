<?php

class Unidad_medida extends CI_Model {

				//listado inicio
				public $idunidad_medida;
				public $unidad_medida;
				public $abreviacion;
				public $tipo_kilo;
				public $tipo_litro;
				public $conversion_base;
				public $distribucion;

				//listado fin

				public function __construct()
        {
                parent::__construct();
								$this->load->database();
        }

        public function get_all_unidad_medida()
        {
                $query = $this->db->get('unidad_medida');
                return $query->result();
        }

				
				public function get_lista_produccion(){
					$this->db->select('*');
					$this->db->from('unidad_medida');
					$this->db->where('tipo_kilo',1);
					$this->db->or_where('tipo_litro',1);
					$query = $this->db->get();
					return $query->result();
				}
				
				public function get_lista_distribucion(){
					$this->db->select('*');
					$this->db->from('unidad_medida');
					$this->db->where('distribucion',1);
					$query = $this->db->get();
					return $query->result();
				}
				
				public function get_lista_unidades(){
					$this->db->select('*');
					$this->db->from('unidad_medida');
					$this->db->where('unidad_productiva',1);
					$query = $this->db->get();
					return $query->result();
				}



        public function insert_unidad_medida()
        {
        	//listado inicio
			$this->idunidad_medida = $this->input->post('idunidad_medida');
			$this->unidad_medida = $this->input->post('unidad_medida');
			$this->abreviacion = $this->input->post('abreviacion');
			$this->tipo_kilo = $this->input->post('tipo_kilo');
			$this->tipo_litro = $this->input->post('tipo_litro');
			$this->conversion_base = $this->input->post('conversion_base');
			$this->distribucion = $this->input->post('distribucion');
			
				
			//listado fin


             //$this->db->insert('NOMBRE_TABLA', $this);
             $this->db->insert('unidad_medida', $this);
        }

        public function update_unidad_medida()
        {
			//listado inicio
            $this->idunidad_medida 	= $this->input->post('idunidad_medida');
			$this->unidad_medida = $this->input->post('unidad_medida');
			$this->abreviacion = $this->input->post('abreviacion');
			$this->tipo_kilo = $this->input->post('tipo_kilo');
			$this->tipo_litro = $this->input->post('tipo_litro');
			$this->conversion_base = $this->input->post('conversion_base');
			$this->distribucion = $this->input->post('distribucion');
			
			//listado fin

                $this->db->update('idunidad_medida', $this, array('idunidad_medida' => $this->input->post('idunidad_medida')));
        }

}