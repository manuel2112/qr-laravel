<?php

if(!function_exists('formatMoney'))
{    
	function formatMoney($value)
	{
		$fmt    = numfmt_create('es_CL', NumberFormatter::CURRENCY);
        $res    = numfmt_format_currency($fmt, $value, "CLP");

        return $res;
	}
}