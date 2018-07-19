<?php

class Producto extends CI_Model {

				//listado inicio
				public $idproducto;
				public $idgrupo_empresas_certificadoras;
				public $idclave_grupo;
				public $folio;
				public $producto_empresas_certificadoras;
				public $variedad_empresas_certificadoras;
				public $nombre_producto_siap;
				public $clave_producto;
				public $nombre_variedad_siap;
				public $clave_variedad;
				public $nombre_clave_subsistema;
				public $clave_subsistema;
				//listado fin

				public function __construct()
        {
                parent::__construct();
								$this->load->database();
        }

        public function get_all_producto()
        {
								$this->db->select('idproducto, producto_empresas_certificadoras, variedad_empresas_certificadoras');
								$this->db->from('producto');
								$this->db->order_by('producto_empresas_certificadoras');
                $query = $this->db->get();
                return $query->result();
        }
				
				public function get_list_producto()
        {
								$this->db->select('idproducto, producto_empresas_certificadoras, variedad_empresas_certificadoras');
								$this->db->from('producto');
								$this->db->order_by('producto_empresas_certificadoras');
								$this->db->group_by('producto_empresas_certificadoras');
                $query = $this->db->get();
                return $query->result();
        }

        public function insert_producto()
        {
        	//listado inicio
			$this->idproducto = $this->input->post('idproducto');
			$this->idgrupo_empresas_certificadoras = $this->input->post('idgrupo_empresas_certificadoras');
			$this->idclave_grupo = $this->input->post('idclave_grupo');
			$this->folio = $this->input->post('folio');
			$this->producto_empresas_certificadoras = $this->input->post('producto_empresas_certificadoras');
			$this->variedad_empresas_certificadoras = $this->input->post('variedad_empresas_certificadoras');
			$this->nombre_producto_siap = $this->input->post('nombre_producto_siap');
			$this->clave_producto = $this->input->post('clave_producto');
			$this->nombre_variedad_siap = $this->input->post('nombre_variedad_siap');
			$this->clave_variedad = $this->input->post('clave_variedad');
			$this->nombre_clave_subsistema = $this->input->post('nombre_clave_subsistema');
			$this->clave_subsistema = $this->input->post('clave_subsistema');
			//listado fin


             //$this->db->insert('NOMBRE_TABLA', $this);
             $this->db->insert('producto', $this);
        }

        public function update_subproducto()
        {
			//listado inicio
            $this->idproducto = $this->input->post('idproducto');
			$this->idgrupo_empresas_certificadoras = $this->input->post('idgrupo_empresas_certificadoras');
			$this->idclave_grupo = $this->input->post('idclave_grupo');
			$this->folio = $this->input->post('folio');
			$this->producto_empresas_certificadoras = $this->input->post('producto_empresas_certificadoras');
			$this->variedad_empresas_certificadoras = $this->input->post('variedad_empresas_certificadoras');
			$this->nombre_producto_siap = $this->input->post('nombre_producto_siap');
			$this->clave_producto = $this->input->post('clave_producto');
			$this->nombre_variedad_siap = $this->input->post('nombre_variedad_siap');
			$this->clave_variedad = $this->input->post('clave_variedad');
			$this->nombre_clave_subsistema = $this->input->post('nombre_clave_subsistema');
			$this->clave_subsistema = $this->input->post('clave_subsistema');				
			//listado fin

                $this->db->update('idproducto', $this, array('idproducto' => $this->input->post('idproducto')));
        }

}