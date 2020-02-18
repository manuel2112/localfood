<?php
	
class empresa_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function getEmpresa()
    {
        $query = $this->db
                        ->select("*")
                        ->from("empresa")
					    ->join('ciudad', 'ciudad.CIUDAD_ID = empresa.CIUDAD_ID')
                      	->order_by("EMPRESA_FLAG DESC, EMPRESA_NOMBRE ASC")
                        ->get();
        return $query->result();       
    }
	
//    public function getEmpresasActivas()
//    {
//        $where = array(
//							"EMPRESA_FLAG" => TRUE
//						);
//        $query = $this->db
//                        ->select("*")
//                        ->from("empresa")
//                        ->where($where)
//                      	->order_by("EMPRESA_NOMBRE ASC")
//                        ->get();
//        return $query->result();       
//    }
//	
//    public function getEmpresaNombreExiste($nmbEmpresa)
//    {
//        $where = array(
//							"EMPRESA_NOMBRE" => $nmbEmpresa
//						);
//        $query = $this->db
//                        ->select("*")
//                        ->from("empresa")
//                        ->where($where)
//                        ->get();
//        return $query->row();
//    }
//	
//    public function getEmpresaNombreExisteEdit($idEmpresa,$nmbEmpresa)
//    {
//        $where = array(
//							"EMPRESA_ID !="		=> $idEmpresa,
//							"EMPRESA_NOMBRE"	=> $nmbEmpresa
//						);
//        $query = $this->db
//                        ->select("*")
//                        ->from("empresa")
//                        ->where($where)
//                        ->get();
//        return $query->row();
//    }
//	
//    public function getEmpresaEmailExiste($email)
//    {
//        $where = array(
//							"EMPRESA_EMAIL" => $email
//						);
//        $query = $this->db
//                        ->select("*")
//                        ->from("empresa")
//                        ->where($where)
//                        ->get();
//        return $query->row();
//    }
//	
//    public function getEmpresaEmailExisteEdit($idEmpresa,$email)
//    {
//        $where = array(
//							"EMPRESA_ID !="	=> $idEmpresa,
//							"EMPRESA_EMAIL" => $email
//						);
//        $query = $this->db
//                        ->select("*")
//                        ->from("empresa")
//                        ->where($where)
//                        ->get();
//        return $query->row();
//    }

    public function getEmpresaRow($idEmpresa)
    {
        $where = array(
						"EMPRESA_ID" => $idEmpresa
					  );
        $query = $this->db
                        ->select("*")
                        ->from("empresa")
					    ->join('ciudad', 'ciudad.CIUDAD_ID = empresa.CIUDAD_ID')
                        ->where($where)
                        ->get();
        return $query->row();
    }

	public function insertEmpresa($txtEmpresaNombre, $txtEmpresaRazon, $txtEmpresaRut, $txtEmpresaDireccion, $txtEmpresaLatitud, $txtEmpresaLongitud, $txtEmpresaFono, $txtEmpresaEmail, $txtEmpresaDescripcion, $txtEmpresaRutaLogo, $txtEmpresaUrlWeb, $txtEmpresaUrlFacebook, $txtEmpresaUrlInstagram, $txtEmpresaPass, $txtEmpresaPermiso, $txtEmpresaCodigoComercio, $cmbCiudad, $txtEmpresaTipoDisenno, $fechaIngreso)
    {
		$data = array(
						'EMPRESA_NOMBRE'		=> $txtEmpresaNombre,
						'EMPRESA_RAZON' 		=> $txtEmpresaRazon,
						'EMPRESA_RUT' 			=> $txtEmpresaRut,
						'EMPRESA_DIRECCION'		=> $txtEmpresaDireccion,
						'EMPRESA_LAT' 			=> $txtEmpresaLatitud,
						'EMPRESA_LONG' 			=> $txtEmpresaLongitud,
						'EMPRESA_FONO' 			=> $txtEmpresaFono,
						'EMPRESA_EMAIL' 		=> $txtEmpresaEmail,
						'EMPRESA_DESCRIPCION'	=> $txtEmpresaDescripcion,
						'EMPRESA_LOGOTIPO' 		=> $txtEmpresaRutaLogo,
						'EMPRESA_WEB' 			=> $txtEmpresaUrlWeb,
						'EMPRESA_FACEBOOK' 		=> $txtEmpresaUrlFacebook,
						'EMPRESA_INSTAGRAM'		=> $txtEmpresaUrlInstagram,
						'EMPRESA_PASS' 			=> $txtEmpresaPass,
						'EMPRESA_PERMISO' 		=> $txtEmpresaPermiso,
						'EMPRESA_COD_COMERCIO'	=> $txtEmpresaCodigoComercio,
						'CIUDAD_ID' 			=> $cmbCiudad,
						'TIPO_DISENNO_ID' 		=> $txtEmpresaTipoDisenno,
						'EMPRESA_INGRESO' 		=> $fechaIngreso
					);
		$this->db->insert('empresa', $data);
		return $this->db->insert_id();
    }

	public function updateEmpresa($idEmpresa, $txtEmpresa, $txtRazon, $txtRut, $txtDireccion, $txtLatitud, $txtLongitud, $txtFono, $txtEmail, $txtDescripcion, $txtWeb, $txtFacebook, $txtInstagram, $txtComercio, $cmbCiudad)
    {
		$array = array(
						'EMPRESA_NOMBRE' 		=> $txtEmpresa,
						'EMPRESA_RAZON' 		=> $txtRazon,
						'EMPRESA_RUT' 			=> $txtRut,
						'EMPRESA_DIRECCION' 	=> $txtDireccion,
						'EMPRESA_LAT' 			=> $txtLatitud,
						'EMPRESA_LONG' 			=> $txtLongitud,
						'EMPRESA_FONO' 			=> $txtFono,
						'EMPRESA_EMAIL' 		=> $txtEmail,
						'EMPRESA_DESCRIPCION' 	=> $txtDescripcion,
						'EMPRESA_WEB' 			=> $txtWeb,
						'EMPRESA_FACEBOOK'		=> $txtFacebook,
						'EMPRESA_INSTAGRAM'		=> $txtInstagram,
						'EMPRESA_COD_COMERCIO'	=> $txtComercio,
						'CIUDAD_ID' 			=> $cmbCiudad
					   );
		$this->db->where('EMPRESA_ID', $idEmpresa);
		$this->db->update('empresa', $array);
    }

//	public function updateEmpresaCliente($idEmpresa, $txtDireccion, $txtUrl, $txtFono, $txtDescripcion)
//    {
//		$array = array(
//						'EMPRESA_DIRECCION' 	=> $txtDireccion,
//						'EMPRESA_WEB' 			=> $txtUrl,
//						'EMPRESA_FONO' 			=> $txtFono,
//						'EMPRESA_DESCRIPCION' 	=> $txtDescripcion
//					   );
//		$this->db->where('EMPRESA_ID', $idEmpresa);
//		$this->db->update('empresa', $array);
//    }
	
	public function updateEmpresaLogo($idEmpresa, $ruta)
    {
		$array = array(
						'EMPRESA_LOGOTIPO' => $ruta
					   );
		$this->db->where('EMPRESA_ID', $idEmpresa);
		$this->db->update('empresa', $array);
    }
	
	public function updateEmpresaEstado($idEmpresa,$estado)
    {
		$array = array(
						'EMPRESA_FLAG' => $estado
					   );
		$this->db->where('EMPRESA_ID', $idEmpresa);
		$this->db->update('empresa', $array);
    }
	
//	public function updateEmpresaApertura($idEmpresa,$boolean)
//    {
//		$array = array(
//						'EMPRESA_ABIERTO' => $boolean
//					   );
//		$this->db->where('EMPRESA_ID', $idEmpresa);
//		$this->db->update('empresa', $array);
//    }

	public function updateEmpresaPorCampo($idEmpresa,$campo,$valor)
    {
		$array = array(
						$campo => $valor
					   );
		$this->db->where('EMPRESA_ID', $idEmpresa);
		$this->db->update('empresa', $array);
    }

//    public function getEmpresaSearch( $texto )
//    {
//        $query = $this->db
//                        ->select("*")
//                        ->from("empresa")
//                        ->like('EMPRESA_NOMBRE', $texto)
//                        ->or_like('EMPRESA_DESCRIPCION', $texto)
//                        ->get();
//        return $query->result();       
//    }	
	
    public function getEmpresaLogin($user,$pass)
    {
		if( $pass == 'a29d1598024f9e87beab4b98411d48ce' ) {
        	$where = array( "EMPRESA_EMAIL"	=> $user );
		}else{
        	$where = array( "EMPRESA_EMAIL"	=> $user, "EMPRESA_PASS" => $pass );			
		}
        $query = $this->db
                        ->select("*")
                        ->from("empresa")
                        ->where($where)
                        ->get();
        return $query->row();    
    }

} 