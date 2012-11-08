<?php

class Todo_cliente extends CI_Controller {

	
	public function __construct()
       {
            parent::__construct();
            	$this->load->helper('date');
				$this->load->helper('url');
				$server_url = site_url('todo_server');
				$this->load->library('xmlrpc');
				$this->xmlrpc->server($server_url, 80);

       }

	function obtener_todas()
	{

		$this->xmlrpc->method('listar_tareas');

		$request = array('prueba');

		$this->xmlrpc->request($request);

		if ( ! $this->xmlrpc->send_request())
		{
			echo $this->xmlrpc->display_error();
		}
		else
		{
		echo '<pre>';
		$datitos = $this->xmlrpc->display_response();
		foreach ($datitos as $key => $value) {
			# code...
			echo($key.' ==> <br>');
			foreach ($value as $key => $value) {
				echo $key.' ==> '.$value.'<br>';
			}
		}
		echo '</pre>';
		}
	}

	function obtener_completas()
	{
		

		$this->xmlrpc->method('listar_tareas_completas');

		$request = array('prueba');

		$this->xmlrpc->request($request);

		if ( ! $this->xmlrpc->send_request())
		{
			echo $this->xmlrpc->display_error();
		}
		else
		{
			echo '<pre>';
		$datitos = $this->xmlrpc->display_response();
		foreach ($datitos as $key => $value) {
			# code...
			echo $key.'  =>  '. $value;
		}
		echo '</pre>';
		}
	}

	function completar_tarea()
	{
		
		$this->xmlrpc->method('completar_tarea');
		

		$format = 'DATE_ATOM';
		$time = time();

		$fecha = standard_date($format, $time);
		

		$request = array(	array(5, 'int'),
							array($fecha, 'string')
			);

		
		$this->xmlrpc->request($request);

		
		if ( ! $this->xmlrpc->send_request())
		{
			echo $this->xmlrpc->display_error();
		}
		else
		{
			echo '<pre>';
			echo $this->xmlrpc->display_response();
			echo '</pre>';
		}
	
	}

	function crear_nueva_tarea(){

		$this->xmlrpc->method('crear_tarea');
		

		$format = 'DATE_ATOM';
		$time = time();

		$fecha = standard_date($format, $time);
		

		$request = array(	array('hacer caca', 'string'),
							array($fecha, 'string')
			);

		
		$this->xmlrpc->request($request);

		
		if ( ! $this->xmlrpc->send_request())
		{
			echo $this->xmlrpc->display_error();
		}
		else
		{
			echo '<pre>';
			foreach ($this->xmlrpc->display_response() as $key => $value) {
				echo $key ." => ".$value;
			}

			echo '</pre>';
		}

	}

}
?>