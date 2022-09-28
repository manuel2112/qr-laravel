<?php

use Illuminate\Support\Carbon;

if(!function_exists('zonaHoraria'))
{	
	function zonaHoraria(){
		$zona = date_default_timezone_set('America/Santiago');
		return $zona;
	}
}

if(!function_exists('diffEntreDosfecha'))
{
	function diffEntreDosfecha($fecha)
	{
		$date1 = Carbon::now();
		$date2 = new DateTime($fecha);
		$diff = $date1->diff($date2);
		
		return $diff->days;
	}
}

if(!function_exists('fechaNow'))
{	
	function fechaNow(){
		zonaHoraria();
		$var = Carbon::now()->format('Y-m-d H:i:s');
		return $var;
	}		
}