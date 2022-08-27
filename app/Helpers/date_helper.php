<?php

use Illuminate\Support\Carbon;

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