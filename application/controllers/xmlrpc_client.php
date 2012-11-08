<?php

class Xmlrpc_client extends CI_Controller {

	function index()
	{
		$this->load->helper('url');
		$server_url = site_url('xmlrpc_server');

		$this->load->library('xmlrpc');

		$this->xmlrpc->server($server_url, 80);
		$this->xmlrpc->method('Greetings');
		//$this->xmlrpc->set_debug(TRUE);

		$request = array('How is it going?');
		$this->xmlrpc->request($request);

		if(! $this->xmlrpc->send_request()){
			$this->xmlrpc->display_error();
		}
		else {
			
			echo '<pre>';
			$datitos = $this->xmlrpc->display_response();
			foreach ($datitos as $key => $value) {
				# code...
				echo $key.'  =>  '. $value;
			}
			echo '</pre>';
		}


	}
}
?>