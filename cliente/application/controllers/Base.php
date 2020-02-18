<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Base extends CI_Controller {
	
	public function __construct()
	{		
		parent::__construct();
		if ( $this->session->userdata('clienteappchan') ) {
			redirect(base_url('cliente'));
		} 
		if (!$this->session->userdata('adminappchan')) {
			$this->session->set_userdata('', current_url());
			redirect(base_url('login'));
		}
        $this->session_id = $this->session->userdata('adminappchan');
	}
	
	public function index()
	{
		echo "Estoy en el home";
	}
	
	public function updatedescarga()
	{
		$valor		= trim($this->input->post('newvalor'));		
		$this->base_model->updateBase($valor);
		echo '1';		
	}
	
}
