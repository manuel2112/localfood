<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if(!function_exists('updateHorario'))
{
	function updateHorario()
	{
		$ci = &get_instance();
		$ci->load->model('empresa_horario_model');
		$ci->load->model('temp_empresa_horario_model');
		
		zonaHoraria();
		$hoy = date('N');
		$timeNow = time();
		
		//LLAMAR TABLA TEMPORALES
		$temporales = $ci->temp_empresa_horario_model->getTempEmpresaHorarioAll();
		if( count($temporales) > 0 )
		{
			foreach( $temporales as $temp ){
				
				//SI TIMECIERRE ES MENOR A TIMENOW => ELIMINO VALOR
				if( $temp->TEMP_HORARIO_CIERRE_TIME < $timeNow ){
					$ci->temp_empresa_horario_model->deleteTempEmpresaHorario($temp->TEMP_HORARIO_ID);
				}
//				if( $temp->TEMP_HORARIO_APERTURA_TIME < $timeNow &&  $temp->TEMP_HORARIO_CIERRE_TIME > $timeNow ){
//					//NADA
//				}else{
//					//ELIMINAR FILA
//					$ci->temp_empresa_horario_model->deleteTempEmpresaHorario($temp->TEMP_HORARIO_ID);
//				}
			}
		}
		
		//LLAMAR TABLA TEMPORALES Y TRUCAR TABLA SI ESTÄ VACIA
		$temporales = $ci->temp_empresa_horario_model->getTempEmpresaHorarioAll();
		if( count($temporales) == 0 ){
			//FORMATEAR TABLA TEMPORALES
			$ci->temp_empresa_horario_model->truncateTempEmpresaHorario();
		}
		
		//LLAMAR EMPRESAS CON ATENCIÓN HOY
		$result	= $ci->empresa_horario_model->getEmpresaHorarioHoyAll($hoy);
		
		foreach( $result as $item )
		{
			$idHorario 		= $item->HORARIO_ID;
			$idEmpresa 		= $item->EMPRESA_ID;
			$idDiaInicio 	= $item->DIA_INICIO_ID;
			$horaApertura 	= $item->HORARIO_APERTURA;
			$idDiaCierre 	= $item->DIA_CIERRE_ID;
			$horaCierre 	= $item->HORARIO_CIERRE;
			
			if( $ci->temp_empresa_horario_model->getTempEmpresaHorarioCount($idHorario) == 0 ){
			
				$timeInicio = strtotime(date($horaApertura));
				$dateInicio = date('D, d M Y H:i:s',$timeInicio);

				if( $idDiaCierre ){	
					$timeCierre = strtotime(date($horaCierre)) + 86400;
				}else{
					$timeCierre = strtotime(date($horaCierre));
				}
				$dateCierre = date('D, d M Y H:i:s',$timeCierre);
				
				//SI TIMECIERRE ES MAYOR A TIMENOW => INGRESO VALOR
				if( $timeCierre > $timeNow ){
					//INSERTAR VALORES EN TABLA TEMPORAL
					$ci->temp_empresa_horario_model->insertTempEmpresaHorario($idHorario, $idEmpresa, $idDiaInicio, $dateInicio, $timeInicio, $idDiaCierre, $dateCierre, $timeCierre);
				}
				
			}
		}

	}
}

if(!function_exists('updateEmpresaAbierta'))
{
	function updateEmpresaAbierta()
	{
		$ci = &get_instance();
		$ci->load->model('empresa_model');
		$ci->load->model('empresa_horario_model');
		$ci->load->model('temp_empresa_horario_model');
		
		zonaHoraria();
		$now = time();
		
		//FORMATEAR empresa_horario A FALSE
		$ci->empresa_horario_model->updateEmpresaHorarioFalseAll();
		
		//LLAMAR TODAS LAS EMPRESAS ACTIVAS
		$result	= $ci->empresa_model->getEmpresasActivas();
		
		foreach( $result as $item )
		{
			$idEmpresa 	= $item->EMPRESA_ID;
			$existe		= $ci->temp_empresa_horario_model->getTempEmpresaHorarioRow($idEmpresa,$now);
			if( $existe ){
				$boolean = TRUE;
				//COLOCAR TRUE HORARIO
				$ci->empresa_horario_model->updateEmpresaHorarioOpen($existe->HORARIO_ID);
			}else{
				$boolean = FALSE;
			}
			$ci->empresa_model->updateEmpresaApertura($idEmpresa,$boolean);
		}
		
	}
}