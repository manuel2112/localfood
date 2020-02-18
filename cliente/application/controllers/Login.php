<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
		//EDITAR PASSWORD
		$this->admin_model->editaPassAdmin(md5(fechaNowPass()));
    }
	
	//CALLBACK ADMINISTRADOR EXISTENTE
	public function administradorExistente()
	{
		$user = $this->input->post("login",true);
		$pass = $this->input->post("pass",true);
		
		$existeAdministrador = $this->admin_model->existeAdministrador($user,md5($pass));
		return $existeAdministrador;
	}

	public function index()
	{
		if ( $this->session->userdata('adminappchan') ) {
			redirect(base_url());
		}
		
		$this->load->view('login/index');
	}

	public function login()
	{
		$user	= trim($this->input->post("usuario",true));
		$pass	= trim($this->input->post("pass",true));
		
		$error	= "";
		
		if( $user == "" ){
			$error	.= "Usuario obligatorio";
		}
		elseif( $pass == "" ){
			$error	.= "Contraseña obligatoria";
		}
		elseif( $user != "" && $pass != "" ){
			if( count($this->admin_model->getSingleAdmin($user,md5($pass))) == 0 && count($this->empresa_model->getEmpresaLogin($user,md5($pass))) == 0 ){
				$error	.= "Usuario y contraseña no coinciden, Favor reintentar ";				
			}elseif( count($this->empresa_model->getEmpresaLogin($user,md5($pass))) > 0 ){
				$admin 		= $this->empresa_model->getEmpresaLogin($user,md5($pass));
				if( !$admin->EMPRESA_PERMISO || !$admin->EMPRESA_FLAG ){
					$error	.= "Estimado cliente, no tienes permisos para ingresar";						
				}			
			}
		}
		
		if( $error != "" ){
			echo $error;
			return;
		}else{
			
			if( count($this->empresa_model->getEmpresaLogin($user,md5($pass))) > 0 ){
				//VALORES ADMINISTRADOR
				$admin 		= $this->empresa_model->getEmpresaLogin($user,md5($pass));
				$idAdmin 	= $admin->EMPRESA_ID;
				$this->session->set_userdata("clienteappchan", $idAdmin);
				$session_id = $this->session->userdata('clienteappchan');
				
				//VALORES PLAN
				$plan 		= $this->plan_model->getEmpresaPlanRow($idAdmin);
				$idPlan 	= $plan->PLAN_ID;
				$this->session->set_userdata("clienteplanappchan", $idPlan);
				$plan_id = $this->session->userdata('clienteplanappchan');
				
				$this->estadistica_back_model->insertEstadisticaBack($idAdmin,1,fechaNow());//INGRESO EMPRESA
			}else{
				$admin 		= $this->admin_model->getSingleAdmin($user,md5($pass));
				$idAdmin 	= $admin->ID_ADMIN;
				$this->session->set_userdata("adminappchan", $idAdmin);
				$session_id = $this->session->userdata('adminappchan');
			}
			
			echo 1;
			return;
		}
	}

    public function logout()
	{
		$this->session->unset_userdata('adminappchan');
		$this->session->unset_userdata('clienteappchan');
		$this->session->unset_userdata('clienteplanappchan');
		$this->session->sess_destroy();
		redirect(base_url().'login', 301);
	}
}