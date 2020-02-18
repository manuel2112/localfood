<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if(!function_exists('formatoDinero'))
{
	function formatoDinero($valor)
	{
		$var = '$'.number_format($valor, 0, ",", ".");
		return $var;
	}
}
