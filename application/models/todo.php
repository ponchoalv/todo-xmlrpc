<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Todo extends CI_Model {

	function __construct()
    {
        parent::__construct();
	   	$this->load->database();
    }


	public function obtener_tareas_todas(){
		$query = $this->db->get('tareas');
		return $query->result_array();
	}

	public function obtener_tareas_completas(){
		$query = $this->db->get_where('tareas', array('completo' => 1));
		return $query->result_array();
	}

	public function grabar_todo($data){
		$this->db->insert('tareas', $data);
		return $this->db->insert_id();
	}

	public function completar_todo($id, $fecha){
		$this->db->where('id',$id);
		$this->db->set('fecha_finalizado',$fecha);
		$this->db->set('completo', 1);
		$this->db->update('tareas');

		return $this->db->affected_rows();
	}



}

/* End of file todo.php */
/* Location: ./application/models/todo.php */
