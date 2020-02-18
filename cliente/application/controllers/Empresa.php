<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empresa extends CI_Controller {
	
	public function __construct()
	{	
		parent::__construct();
		if (!$this->session->userdata('adminappchan')) {
			$this->session->set_userdata('', current_url());
			redirect(base_url('login'));
		}        
        $this->session_id = $this->session->userdata('adminappchan');
	}
	
	public function index()
	{
		//DATOS BASE
		$data["ciudades"]	= $this->ciudad_model->getCiudad();
		$data["comidas"] 	= $this->tipo_comida_model->getTiposComidaActive();
		$data["negocios"] 	= $this->tipo_negocio_model->getTiposNegocioActive();
		$data["pagos"] 		= $this->tipo_pago_model->getTiposPagoActive();
		$data["dias"] 		= $this->dia_model->getDias();
		$data["planes"]		= $this->plan_model->getPlan();
		$this->layout->view('index',$data);
	}
    
	public function indexajax()
	{
		$empresas = $this->empresa_model->getEmpresa();
		
		$dataJson = '{
					  "data": [';
		
		$i = 1;		
		if( count($empresas) > 0 ){
			foreach( $empresas as $item )
			{				
				$imagen = $item->EMPRESA_LOGOTIPO ? "<img src='".base_url().$item->EMPRESA_LOGOTIPO."' width='50px'>" : "<img src='".base_url()."public/images/food-defecto.png' width='50px'>";
				
				//ACCIONES
				$botones =  "<div class='btn-group'>";
				$botones .=  "<button class='btn btn-warning btnGetEditarEmpresa' idempresa='".$item->EMPRESA_ID."' data-toggle='modal' data-target='#modalEditarEmpresa' data-toggle='popover' data-trigger='hover' data-placement='top' data-content='Now hover out.'><i class='fa fa-pencil fa-lg'></i></button>";
				$botones .=  "<button class='btn btn-primary btnGetVerEmpresa' idempresa='".$item->EMPRESA_ID."' data-toggle='modal' data-target='#modalVerEmpresa' title='DETALLE EMPRESA'><i class='fa fa-info-circle fa-lg'></i></button>";
				$botones .=  "<button class='btn btn-danger btnInsertHorario' idempresa='".$item->EMPRESA_ID."' data-toggle='modal' data-target='#modalInsertHorario' title='HORARIOS'><i class='fa fa-clock-o fa-lg'></i></button>";
				$botones .=  "<button class='btn btn-info btnInsertFoto' idempresa='".$item->EMPRESA_ID."' data-toggle='modal' data-target='#modalInsertFoto' title='IMÁGENES PERFIL'><i class='fa fa-image fa-lg'></i></button>";
				$botones .=  "<button class='btn btn-success btnInsertPlan' idempresa='".$item->EMPRESA_ID."' data-toggle='modal' data-target='#modalInsertPlan' title='PLANES'><i class='fa fa-shopping-cart fa-lg'></i></button>";
				
				//DAR PERMISOS
				$botones .= $item->EMPRESA_PERMISO ?  "<button class='btn btn-success btnDarPermisos' idempresa='".$item->EMPRESA_ID."' valor='0' title='PERMISOS PARA INGRESAR'><i class='fa fa-thumbs-up fa-lg'></i></button>" : "<button class='btn btn-danger btnDarPermisos' idempresa='".$item->EMPRESA_ID."' valor='1' title='PERMISOS PARA INGRESAR'><i class='fa fa-thumbs-down fa-lg'></i></button>" ;
				
				//ACTIVAR DESACTIVAR
				$botones .= $item->EMPRESA_FLAG ?  "<button class='btn btn-success btnActivarEmpresa' idempresa='".$item->EMPRESA_ID."'  estadoempresa='0' title='ACTIVAR/DESACTIVAR EMPRESA'><i class='fa fa-check fa-lg'></i></button>" : "<button class='btn btn-danger btnActivarEmpresa' idempresa='".$item->EMPRESA_ID."'  estadoempresa='1' title='ACTIVAR/DESACTIVAR EMPRESA'><i class='fa fa-times fa-lg'></i></button>" ;
				$botones .=  "</div>";
				
				$geo = $item->EMPRESA_DIRECCION ? "<i class='fa fa-check fa-lg btn btn-success'></i>" : "<i class='fa fa-times fa-lg btn btn-danger'></i>" ;
				
				$open = $item->EMPRESA_ABIERTO ? "<i class='fa fa-check fa-lg btn btn-success'></i>" : "<i class='fa fa-times fa-lg btn btn-danger'></i>" ;

				$dataJson .= '[
								  "'.$i++.'",
								  "'.$item->EMPRESA_ID.'",
								  "'.$imagen.'",
								  "'.$item->EMPRESA_NOMBRE.'",
								  "'.$item->CIUDAD_NOMBRE.'",
								  "'.$geo.'",
								  "'.$open.'",
								  "'.$botones.'"
							  ],';
			}			
		}else{
				$dataJson .= '[
								  "SIN INFORMACIÓN",
								  "---",
								  "---",
								  "---",
								  "---",
								  "---",
								  "---",
								  "---"
							  ],';			
		}

		
		$dataJson = substr($dataJson, 0, -1);
		$dataJson .= '] }';
		
		echo $dataJson;
	}
    
	public function insert()
	{
		$cmbCiudad 		= trim($this->input->post('cmbCiudad')) ? trim($this->input->post('cmbCiudad')) : NULL ;
		$txtEmpresa 	= trim($this->input->post('txtEmpresa')) ? trim($this->input->post('txtEmpresa')) : NULL ;
		$txtDireccion 	= trim($this->input->post('txtDireccion')) ? ucwords(strtolower(trim($this->input->post('txtDireccion')))) : NULL ;
		$txtLatitud 	= trim($this->input->post('txtLatitud')) ? trim($this->input->post('txtLatitud')) : NULL ;
		$txtLongitud 	= trim($this->input->post('txtLongitud')) ? trim($this->input->post('txtLongitud')) : NULL ;
		$txtUrl 		= trim($this->input->post('txtUrl')) ? trim($this->input->post('txtUrl')) : NULL ;
		$txtFono 		= trim($this->input->post('txtFono')) ? trim($this->input->post('txtFono')) : NULL ;
		$txtEmail 		= trim($this->input->post('txtEmail')) ? trim($this->input->post('txtEmail')) : NULL ;
		$txtDescripcion = trim($this->input->post('txtDescripcion')) ? trim($this->input->post('txtDescripcion')) : NULL ;
		$fechaIngreso	= fechaNow();
		$ruta 			= NULL;
		
		//CKECKBOXS
		$tipoComida 	= $this->input->post('chktipocomida');
		$tipoNegocio	= $this->input->post('chktiponegocio');
		$tipoPago 		= $this->input->post('chktipopago');
		
		//INGRESAR EMPRESA
		$idEmpresa = $this->empresa_model->insertEmpresa($cmbCiudad, $txtEmpresa, $txtDireccion, $txtLatitud, $txtLongitud, $txtUrl, $txtFono, $txtEmail, $txtDescripcion, $fechaIngreso);
		
		//INGRESAR TIPO COMIDA
		foreach( $tipoComida as $itemTipoComida ){
			$this->tipo_comida_model->insertTipoComidaEmpresa($idEmpresa,$itemTipoComida);
		}
		//INGRESAR TIPO NEGOCIO
		foreach( $tipoNegocio as $itemTipoNegocio ){
			$this->tipo_negocio_model->insertTipoNegocioEmpresa($idEmpresa,$itemTipoNegocio);
		}
		//INGRESAR TIPO PAGO
		foreach( $tipoPago as $itemTipoPago ){
			$this->tipo_pago_model->insertTipoPagoEmpresa($idEmpresa,$itemTipoPago);
		}
		
		
		//VALIDAR IMAGEN
		if( !empty($_FILES["nuevaFotoEmpresa"]["tmp_name"]) ){

			list($ancho,$alto) = getimagesize($_FILES["nuevaFotoEmpresa"]["tmp_name"]);
			
			$anchoMaximo = 500;
			$altoProporcional = ($anchoMaximo * $alto) / $ancho;

			$nuevoAncho	= $anchoMaximo;
			$nuevoAlto	= $altoProporcional;
					
			//CREAR DIRECTORIO PARA GUARDAR FOTO
			if (!file_exists("upload/empresas/".$idEmpresa."/logotipo")) {
				mkdir("upload/empresas/".$idEmpresa."/logotipo", 0777, true);
			}
			$directorio = "upload/empresas/".$idEmpresa."/logotipo";
					
			if( $_FILES["nuevaFotoEmpresa"]["type"] == "image/jpeg" ){
				$aleatorio	= generaRandom();
				$ruta		= $directorio."/".$aleatorio.".jpg";
				
				$origen		= imagecreatefromjpeg($_FILES["nuevaFotoEmpresa"]["tmp_name"]);
				$destino	= imagecreatetruecolor($nuevoAncho,$nuevoAlto);
				
				imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoAlto,$ancho,$alto);
				
				imagejpeg($destino,$ruta);
			}
					
			if( $_FILES["nuevaFotoEmpresa"]["type"] == "image/png" ){
				$aleatorio	= generaRandom();
				$ruta		= $directorio."/".$aleatorio.".png";
				
				$origen		= imagecreatefrompng($_FILES["nuevaFotoEmpresa"]["tmp_name"]);
				$destino	= imagecreatetruecolor($nuevoAncho,$nuevoAlto);
				
				imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoAlto,$ancho,$alto);
				
				imagejpeg($destino,$ruta);
			}
			$this->empresa_model->updateEmpresaLogo($idEmpresa, $ruta);
		}
		
		$success = 'Empresa '.$txtEmpresa.' ingresada exitosamente.';
		$this->session->set_flashdata('exito',$success);
		redirect(base_url().'empresa');
	}
    
	public function estado()
	{
		$idEmpresa 	= trim($this->input->post('idempresa'));
		$estado		= trim($this->input->post('estado'));
		$empresa 	= $this->empresa_model->getEmpresaRow($idEmpresa);

		$this->empresa_model->updateEmpresaEstado($idEmpresa,$estado);
		
		if( $estado == 0 ){
			//eliminar valores relacionados
			$this->empresa_model->updateEmpresaPorCampo($idEmpresa,'EMPRESA_PERMISO',$estado);
			$this->destacado_model->updateDestacadoEstado($idEmpresa,$estado);
			$this->empresa_foto_model->updateEmpresaFotoEstado($idEmpresa,$estado);
			$this->empresa_horario_model->deleteEmpresaAllHorario($idEmpresa);
			$this->empresa_notificacion_model->updateNotificacionEmpresaDown($idEmpresa);
			$plan = $this->plan_model->getEmpresaPlanLastRow($idEmpresa);
			$this->plan_model->updateEmpresaPlanLastRow($plan->EMPRESA_PLAN_ID,fechaNow());
			$this->plan_model->updateEmpresaPlan($idEmpresa);

			$title	= "Eliminada";
			$text	= "La Empresa ha sido eliminada";
		}else{
			$title	= "Aceptada";
			$text	= "La Empresa ha sido aceptada";			
		}		

		$data = array();
		$data['title'] = $title;
		$data['text'] = $text;
		echo json_encode($data);
	}
    
	public function geteditar()
	{
		$idEmpresa 	= trim($this->input->post('idEmpresa'));

		$data = array();
		$data['empresa'] 			= $this->empresa_model->getEmpresaRow($idEmpresa);
		$data['tiposdecomida'] 		= $this->tipo_comida_model->getTipoComidaEmpresa($idEmpresa);
		$data['tiposdecomidaall']	= $this->tipo_comida_model->getTiposComidaActive();
		$data['tiposdenegocio'] 	= $this->tipo_negocio_model->getTipoNegocioEmpresa($idEmpresa);
		$data['tiposdenegocioall'] 	= $this->tipo_negocio_model->getTiposNegocioActive();
		$data['tiposdepago'] 		= $this->tipo_pago_model->getTipoPagoEmpresa($idEmpresa);
		$data['tiposdepagoall'] 	= $this->tipo_pago_model->getTiposPagoActive();	
		echo json_encode($data);
	}
  
	public function editar()
	{
		$idEmpresa		= $this->input->post('idEditEmpresa');
		$cmbCiudad 		= trim($this->input->post('cmbEditCiudad')) ? trim($this->input->post('cmbEditCiudad')) : NULL ;
		$txtEmpresa 	= trim($this->input->post('txtEditEmpresa')) ? trim($this->input->post('txtEditEmpresa')) : NULL ;
		$txtDireccion 	= trim($this->input->post('txtEditDireccion')) ? ucwords(strtolower(trim($this->input->post('txtEditDireccion')))) : NULL ;
		$txtLatitud 	= trim($this->input->post('txtEditLatitud')) ? trim($this->input->post('txtEditLatitud')) : NULL ;
		$txtLongitud 	= trim($this->input->post('txtEditLongitud')) ? trim($this->input->post('txtEditLongitud')) : NULL ;
		$txtUrl 		= trim($this->input->post('txtEditUrl')) ? trim($this->input->post('txtEditUrl')) : NULL ;
		$txtFono 		= trim($this->input->post('txtEditFono')) ? trim($this->input->post('txtEditFono')) : NULL ;
		$txtEmail 		= trim($this->input->post('txtEditEmail')) ? trim($this->input->post('txtEditEmail')) : NULL ;
		$txtDescripcion = trim($this->input->post('txtEditDescripcion')) ? trim($this->input->post('txtEditDescripcion')) : NULL ;
		$ruta 			= NULL;
		
		//CKECKBOXS
		$tipoComida 	= $this->input->post('chktipocomida');
		$tipoNegocio	= $this->input->post('chktiponegocio');
		$tipoPago 		= $this->input->post('chktipopago');
		
		//UPDATE EMPRESA
		$this->empresa_model->updateEmpresa($idEmpresa, $cmbCiudad, $txtEmpresa, $txtDireccion, $txtLatitud, $txtLongitud, $txtUrl, $txtFono, $txtEmail, $txtDescripcion);
		
		//INGRESAR TIPO COMIDA
		$this->tipo_comida_model->deleteTipoComidaEmpresa($idEmpresa);
		foreach( $tipoComida as $itemTipoComida ){
			$this->tipo_comida_model->insertTipoComidaEmpresa($idEmpresa,$itemTipoComida);
		}
		//INGRESAR TIPO NEGOCIO
			$this->tipo_negocio_model->deleteTipoNegocioEmpresa($idEmpresa);
		foreach( $tipoNegocio as $itemTipoNegocio ){
			$this->tipo_negocio_model->insertTipoNegocioEmpresa($idEmpresa,$itemTipoNegocio);
		}
		//INGRESAR TIPO PAGO
			$this->tipo_pago_model->deleteTipoPagoEmpresa($idEmpresa);
		foreach( $tipoPago as $itemTipoPago ){
			$this->tipo_pago_model->insertTipoPagoEmpresa($idEmpresa,$itemTipoPago);
		}
		
		
		//VALIDAR IMAGEN
		if( !empty($_FILES["EditFotoEmpresa"]["tmp_name"]) ){

			list($ancho,$alto) = getimagesize($_FILES["EditFotoEmpresa"]["tmp_name"]);
			
			$anchoMaximo = 500;
			$altoProporcional = ($anchoMaximo * $alto) / $ancho;

			$nuevoAncho	= $anchoMaximo;
			$nuevoAlto	= $altoProporcional;
					
			//CREAR DIRECTORIO PARA GUARDAR FOTO
			if (!file_exists("upload/empresas/".$idEmpresa."/logotipo")) {
				mkdir("upload/empresas/".$idEmpresa."/logotipo", 0777, true);
			}
			$directorio = "upload/empresas/".$idEmpresa."/logotipo";

			//ELIMINAR ARCHIVOS DEL DIRECTORIO
			$files = glob( $directorio . '/*' );
			foreach($files as $file){
				if(is_file($file))
				unlink($file);
			}
					
			if( $_FILES["EditFotoEmpresa"]["type"] == "image/jpeg" ){
				$aleatorio	= generaRandom();
				$ruta		= $directorio."/".$aleatorio.".jpg";
				
				$origen		= imagecreatefromjpeg($_FILES["EditFotoEmpresa"]["tmp_name"]);
				$destino	= imagecreatetruecolor($nuevoAncho,$nuevoAlto);
				
				imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoAlto,$ancho,$alto);
				
				imagejpeg($destino,$ruta);
			}
					
			if( $_FILES["EditFotoEmpresa"]["type"] == "image/png" ){
				$aleatorio	= generaRandom();
				$ruta		= $directorio."/".$aleatorio.".png";
				
				$origen		= imagecreatefrompng($_FILES["EditFotoEmpresa"]["tmp_name"]);
				$destino	= imagecreatetruecolor($nuevoAncho,$nuevoAlto);
				
				imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoAlto,$ancho,$alto);
				
				imagejpeg($destino,$ruta);
			}
			$this->empresa_model->updateEmpresaLogo($idEmpresa, $ruta);
		}
		
		$success = 'Empresa '.$txtEmpresa.' editada exitosamente.';
		$this->session->set_flashdata('exito',$success);
		redirect(base_url().'empresa');
	}
    
	public function getfoto()
	{
		$idEmpresa 	= trim($this->input->post('idEmpresa'));
		
		$data = array();
		$data['empresa']	= $this->empresa_model->getEmpresaRow($idEmpresa);
		$data['fotos'] 		= $this->empresa_foto_model->getEmpresaFotoActive($idEmpresa);
		echo json_encode($data);
	}
    
	public function gethorario()
	{
		$idEmpresa 	= trim($this->input->post('idEmpresa'));
		
		$data = array();
		$data['empresa']	= $this->empresa_model->getEmpresaRow($idEmpresa);
		$data['horario']	= $this->empresa_horario_model->getEmpresaHorarioRow($idEmpresa);
		echo json_encode($data);
	}
    
	public function insertValidarEmpresa()
	{
		$nmbEmpresa	= trim($this->input->post('nmbEmpresa'));
		$existe = $this->empresa_model->getEmpresaNombreExiste($nmbEmpresa);
		if( count($existe) > 0 ){
			echo "EXISTE";
		}
	}
    
	public function updateValidarEmpresa()
	{
		$idEmpresa	= trim($this->input->post('idEmpresa'));
		$nmbEmpresa	= trim($this->input->post('nmbEmpresa'));
		
		$existe = $this->empresa_model->getEmpresaNombreExisteEdit($idEmpresa,$nmbEmpresa);
		if( count($existe) > 0 ){
			echo "EXISTE";
		}
	}
    
	public function insertValidarEmail()
	{
		$email 	= trim($this->input->post('email'));
		$existe = $this->empresa_model->getEmpresaEmailExiste($email);
		if( count($existe) > 0 ){
			echo "EXISTE";
		}
	}
    
	public function updateValidarEmail()
	{
		$idEmpresa	= trim($this->input->post('idEmpresa'));
		$email		= trim($this->input->post('emailEmpresa'));
		
		$existe = $this->empresa_model->getEmpresaEmailExisteEdit($idEmpresa,$email);
		if( count($existe) > 0 ){
			echo "EXISTE";
		}
	}
    
	public function inserthorario()
	{
		$idEmpresa	= trim($this->input->post('idempresa')) ? trim($this->input->post('idempresa')) : NULL ;
		$diaInicio	= trim($this->input->post('diainicio')) ? trim($this->input->post('diainicio')) : NULL ;
		$horaInicio	= trim($this->input->post('horainicio')) ? trim($this->input->post('horainicio')) : NULL ;
		$diaCierre	= trim($this->input->post('diacierre')) ? trim($this->input->post('diacierre')) : NULL ;
		$horaCierre	= trim($this->input->post('horacierre')) ? trim($this->input->post('horacierre')) : NULL ;
		
		$this->empresa_horario_model->insertEmpresaHorario( $idEmpresa, $diaInicio, $horaInicio, $diaCierre, $horaCierre );
		
		$data = array();
		$data['horario']	= $this->empresa_horario_model->getEmpresaHorarioRow($idEmpresa);
		echo json_encode($data);
	}
    
	public function deletehorario()
	{
		$idEmpresa 	= trim($this->input->post('idEmpresa'));
		$idHorario 	= trim($this->input->post('idHorario'));
		
		$this->empresa_horario_model->deleteEmpresaHorario($idHorario);
		
		$data = array();
		$data['empresa']	= $this->empresa_model->getEmpresaRow($idEmpresa);
		$data['horario']	= $this->empresa_horario_model->getEmpresaHorarioRow($idEmpresa);
		echo json_encode($data);
	}
    
	public function insertfoto()
	{
		$idEmpresa		= $this->input->post('idEmpresaFoto');
		$imagenes 		= $_FILES["file-es"];
		$fechaIngreso	= fechaNow();
		$ruta 			= NULL;

		//FORMATEAR ESTADOS
		$this->empresa_foto_model->updateEmpresaFotoEstado($idEmpresa,FALSE);

		//CREAR DIRECTORIO PARA GUARDAR FOTO
		if (!file_exists("upload/empresas/".$idEmpresa."/promocion")) {
			mkdir("upload/empresas/".$idEmpresa."/promocion", 0777, true);
		}
		$directorio = "upload/empresas/".$idEmpresa."/promocion";
		
		//ELIMINAR ARCHIVOS DEL DIRECTORIO
		$files = glob( $directorio . '/*' );
		foreach($files as $file){
			if(is_file($file))
			unlink($file);
		}

		for($i = 0; $i < count($_FILES['file-es']['name']); $i++)
		{
			$imgType = $_FILES['file-es']['type'][$i];
			$imgTemp = $_FILES['file-es']['tmp_name'][$i];

			//VALIDAR IMAGEN
			if( !empty($imgTemp) )
			{
				list($ancho,$alto) = getimagesize($imgTemp);

				$anchoMaximo = 500;
				$altoProporcional = ($anchoMaximo * $alto) / $ancho;

				$nuevoAncho	= $anchoMaximo;
				$nuevoAlto	= $altoProporcional;

				if( $imgType == "image/jpeg" ){
					$aleatorio	= generaRandom();
					$ruta		= $directorio."/promocion_".$aleatorio.".jpg";

					$origen		= imagecreatefromjpeg($imgTemp);
					$destino	= imagecreatetruecolor($nuevoAncho,$nuevoAlto);

					imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoAlto,$ancho,$alto);

					imagejpeg($destino,$ruta);
				}

				if( $imgType == "image/png" ){
					$aleatorio	= generaRandom();
					$ruta		= $directorio."/promocion_".$aleatorio.".png";

					$origen		= imagecreatefrompng($imgTemp);
					$destino	= imagecreatetruecolor($nuevoAncho,$nuevoAlto);

					imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoAlto,$ancho,$alto);

					imagejpeg($destino,$ruta);
				}
				$this->empresa_foto_model->insertEmpresaFoto($idEmpresa,$ruta,$fechaIngreso);
			}
			
			if( $i == 4 ){
				break;
			}
		}

		$success = 'Destacado ingresado exitosamente.';
		$this->session->set_flashdata('exito',$success);
		redirect(base_url().'empresa');
	}
    
//	public function insertfoto()
//	{
//		$idEmpresa		= $this->input->post('idempresa');
//		$fechaIngreso	= fechaNow();		
//		$ruta 			= "";
//		
//		$imagen		= $this->input->post('rutaimagen');		
//		list($type, $imagen) 	= explode(';', $imagen);
//		list(, $imagen)      	= explode(',', $imagen);
//		$imagen64 				= base64_decode($imagen);
//
//		
//
//		//VALIDAR IMAGEN
//		if( !empty($this->input->post('rutaimagen')) ){
//
//			list($ancho,$alto) = getimagesize('data://application/octet-stream;base64,'.$imagen);
//			
//			$anchoMaximo = 500;
//			$altoProporcional = ($anchoMaximo * $alto) / $ancho;
//
//			$nuevoAncho	= $anchoMaximo;
//			$nuevoAlto	= $altoProporcional;
//					
//			//CREAR DIRECTORIO PARA GUARDAR FOTO
//			if (!file_exists("upload/empresas/".$idEmpresa)) {
//				mkdir("upload/empresas/".$idEmpresa, 0777, true);
//			}
//			$directorio = "upload/empresas/".$idEmpresa;
//					
//			if( $type == "data:image/jpeg" ){
//				$aleatorio	= generaRandom();
//				$ruta		= $directorio."/promo_".$aleatorio.".jpg";
//				
//				$origen		= imagecreatefromstring($imagen64);
//				$destino	= imagecreatetruecolor($nuevoAncho,$nuevoAlto);
//				
//				imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoAlto,$ancho,$alto);
//				
//				imagejpeg($destino,$ruta);
//			}
//					
//			if( $type == "data:image/png" ){
//				$aleatorio	= generaRandom();
//				$ruta		= $directorio."/promo_".$aleatorio.".png";
//				
//				$origen		= imagecreatefromstring($imagen64);
//				$destino	= imagecreatetruecolor($nuevoAncho,$nuevoAlto);
//				
//				imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoAlto,$ancho,$alto);
//				
//				imagejpeg($destino,$ruta);
//			}
//		}
//		
//		$this->empresa_foto_model->insertEmpresaFoto($idEmpresa,$ruta,$fechaIngreso);
//		
//		$data = array();
//		$data['fotos'] = $this->empresa_foto_model->getEmpresaFotoActive($idEmpresa);
//		echo json_encode($data);
//	}	
    
	public function deletefotopromo()
	{
		$idEmpresa 	= trim($this->input->post('idEmpresa'));
		$idFoto 	= trim($this->input->post('idfoto'));

		$row = $this->empresa_foto_model->getEmpresaFotoRow($idFoto);

		//ELIMINAR ARCHIVO DEL SERVIDOR
		$file = $row->FOTO_URL;
		unlink($file);

		//ELIMINAR ARCHIVO DE LA BD
		$this->empresa_foto_model->deleteEmpresaFoto($idFoto);

		$data = array();
		$data['fotos'] = $this->empresa_foto_model->getEmpresaFotoActive($idEmpresa);
		echo json_encode($data);
	}
    
	public function getplan()
	{
		$idEmpresa 	= trim($this->input->post('idEmpresa'));
		
		$data = array();
		$data['empresa']	= $this->empresa_model->getEmpresaRow($idEmpresa);
		$data['planes']		= $this->plan_model->getEmpresaPlan($idEmpresa);
		echo json_encode($data);
	}
    
	public function insertplan()
	{
		$idEmpresa	= trim($this->input->post('idempresa')) ? trim($this->input->post('idempresa')) : NULL ;
		$idPlan		= trim($this->input->post('cmbPlan')) ? trim($this->input->post('cmbPlan')) : NULL ;
		$fechaComienzo	= fechaNow();
		$fechaFin		= $idPlan != 1 ? fechaMasUnMes($fechaComienzo) : NULL ;
		
		//RECUPERAR ÚLTIMA FILA TRUE SI ES PLAN 1 ACTUALIZAR FECHA CIERRE
		$last = $this->plan_model->getEmpresaPlanLastRow($idEmpresa);
		if( count($last) > 0 && $last->PLAN_ID == 1 ){
			$this->plan_model->updateEmpresaPlanLastRow($last->EMPRESA_PLAN_ID,$fechaComienzo);
		}
		
		$this->plan_model->updateEmpresaPlan($idEmpresa);
		$this->plan_model->insertEmpresaPlan( $idEmpresa, $idPlan, $fechaComienzo, $fechaFin );
		
		$data = array();
		$data['planes']		= $this->plan_model->getEmpresaPlan($idEmpresa);
		echo json_encode($data);
	}
    
	public function updatepermisos()
	{
		$idEmpresa	= trim($this->input->post('idempresa')) ;
		$valor		= trim($this->input->post('valor')) ;
		$empresa 	= $this->empresa_model->getEmpresaRow($idEmpresa);
		
		if( $empresa->EMPRESA_EMAIL ){
			$this->empresa_model->updateEmpresaPorCampo($idEmpresa,'EMPRESA_PERMISO',$valor);

			if( $valor == 1 ){
				//CREAR PASSWORD		
				$nuevoPass	= generaPass();
				$empresa 	= $this->empresa_model->updateEmpresaPorCampo($idEmpresa,'EMPRESA_PASS',md5($nuevoPass));
				
				//ENVIAR MENSAJE CON PASSWORD
				$nmbEmpresa	= $empresa->EMPRESA_NOMBRE;
				$email		= $empresa->EMPRESA_EMAIL;
				$asunto		= 'Permisos de Ingreso';
				$exito 		= email_permisos_ingreso($nmbEmpresa,$email,$asunto,$nuevoPass);
				
				$title	= "ACEPTADO";
				$text	= "Se han otorgado los permisos para ingresar.";
			}else{
				$title	= "ELIMINADO";
				$text	= "Se han eliminado los permisos para ingresar";			
			}			
		}else{
			$title	= "ERROR";
			$text	= "Debe ser ingresado el correo del cliente para otorgar permisos";
		}		

		$data = array();
		$data['title'] = $title;
		$data['text'] = $text;
		echo json_encode($data);
	}

}
