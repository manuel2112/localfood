<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if(!function_exists('generaPass'))
{    
	function generaPass()
	{
		$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
		$cad = "";
		for($i=0;$i<6;$i++) {
			$cad .= substr($str,rand(0,62),1);
		}
		return $cad;
	}
}