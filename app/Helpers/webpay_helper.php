<?php

if(!function_exists('payLog'))
{    
	function payLog($orden, $log)
	{
        $var  = '';
        $var .= 'FECHA: ' . fechaNow() ."\n";
        $var .= 'vci: ' . $log->vci ."\n";
        $var .= 'amount: ' . $log->amount ."\n";
        $var .= 'status: ' . $log->status ."\n";
        $var .= 'buyOrder: ' . $log->buyOrder ."\n";
        $var .= 'sessionId: ' . $log->sessionId ."\n";
        $var .= 'card_number: ' . $log->cardNumber ."\n";
        $var .= 'accountingDate: ' . $log->accountingDate ."\n";
        $var .= 'transactionDate: ' . $log->transactionDate ."\n";
        $var .= 'authorizationCode: ' . $log->authorizationCode ."\n";
        $var .= 'paymentTypeCode: ' . $log->paymentTypeCode ."\n";
        $var .= 'responseCode: ' . $log->responseCode ."\n";
        $var .= 'installmentsAmount: ' . $log->installmentsAmount ."\n";
        $var .= 'installmentsNumber: ' . $log->installmentsNumber ."\n";
        $var .= 'balance: ' . $log->balance ."\n";
        
        logCompra($orden,$var);
	}
}

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