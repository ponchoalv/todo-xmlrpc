<?php

class Todo_server extends CI_Controller {

	public function __construct()
       {
            parent::__construct();



       }

	function index()
	{
	 	$this->load->model('todo');
        $this->load->library('xmlrpc');
		$this->load->library('xmlrpcs');
		$config['functions']['listar_tareas'] = array('function' => 'Todo_server.listar_todas');
		$config['functions']['listar_tareas_completas'] = array('function' => 'Todo_server.listar_completas');
		$config['functions']['completar_tarea'] = array('function' => 'Todo_server.completar_todo');
		$config['functions']['crear_tarea'] = array('function' => 'Todo_server.crear_nueva_tarea');

		$this->xmlrpcs->initialize($config);
		$this->xmlrpcs->serve();
	}


	/*
		Paramestros: array $datos
						
		Tarea:	Funcion generica para pasar un array asociativo a una estructura rpc,
				para compatibilizar el formato de php con el generado en xml

		Retorna: array asociativo reestructarado para poder trasnmitirlo como xml.
	*/

	function trasnformar_array_en_rpc($datos){

		$datos_parseado = array();
		
		foreach ($datos as  $key => $value) {
			$datos_parseado[$key] = array($value,'struct');
		}

		$datos_parseado = array($datos_parseado,'struct');

		return $datos_parseado;
	}

	/*
		Paramestros: -
						
		Tarea:	Listar todas las treas.

		Retorna: Array con todas las treas.
	*/

	function listar_todas($request)
	{
		//$parameters = $request->output_parameters();

		$datos =$this->todo->obtener_tareas_todas();
		$datos = $this->trasnformar_array_en_rpc($datos);
		return $this->xmlrpc->send_response($datos);
	}

	/*
		Paramestros: -
						
		Tarea:	Listar las treas completadas.

		Retorna: Array con las treas completas.
	*/

	function listar_completas ($request)
	{
		//$parameters = $request->output_parameters();

		$datos = $this->todo->obtener_tareas_completas();

		$datos = $this->trasnformar_array_en_rpc($datos);

		return $this->xmlrpc->send_response($datos);
	}




	/*
		Paramestros: int $id, string $fecha
		
		Tarea:	Completa una tarea, la que tenga id = $id, cambiando el flag de completado por 1, 
				y la fecha de finalización por $fecha.

		Retorna: Cantidad de tareas afectadas, debe ser 1 en todos los casos.
	*/

	function completar_todo($request){
		$parameters = $request->output_parameters();

		if(sizeof($parameters) < 2){
			return $this->xmlrpc->send_error_message('1','Faltan parametros, debe ingresar exactamente 2 paramatros: id, y fecha.');
		}

		$id = $parameters[0];

		$fecha = $parameters[1];

		$completo = $this->todo->completar_todo($id, $fecha);

		$datos = array($completo, 'string');

		return $this->xmlrpc->send_response($datos);
	}


	/*
		Paramestros: string $nombre, string $fecha
						
		Tarea:	Crea una nueva tarea, con nombre $nombre y fecha_estimado $fecha.

		Retorna: id de la nueva tarea
	*/

	function crear_nueva_tarea($request){
		$parameters = $request->output_parameters();

		if(sizeof($parameters) < 2){
			return $this->xmlrpc->send_error_message('2','Faltan parametros, debe ingresar exactamente 2 paramatros: nombre, y fecha.');
		}



		$datos['nombre'] = $parameters[0];
		$datos['fecha_estimado'] = $parameters[1];

		$id = $this->todo->grabar_todo($datos);

		$respuesta = array( array('id' => $id),'struct');

		return	$this->xmlrpc->send_response($respuesta);

	}

}
?>