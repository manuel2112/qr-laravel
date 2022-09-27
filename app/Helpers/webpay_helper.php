<?php

if(!function_exists('tipoPago'))
{    
	function tipoPago($tipo)
	{
        switch ($tipo) {
            case 'VD':
                $var = 'VENTA DÉBITO';
                break;
            case 'VN':
                $var = 'VENTA NORMAL';
                break;
            case 'VC':
                $var = 'VENTA EN CUOTAS';
                break;
            case 'SI':
                $var = '3 CUOTAS SIN INTERÉS';
                break;
            case 'S2':
                $var = '2 CUOTAS SIN INTERÉS';
                break;
            case 'NC':
                $var = 'N CUOTAS SIN INTERÉS';
                break;
            case 'VP':
                $var = 'VENTA PREPAGO';
                break;
            default:
            $var = '';
        }

        return $var;
	}
}