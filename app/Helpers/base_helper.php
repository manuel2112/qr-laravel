<?php

if(!function_exists('urlQR'))
{    
	function urlQR()
	{
		$whitelist = array( '127.0.0.1', '::1' );
		
		if ( in_array( $_SERVER['REMOTE_ADDR'], $whitelist ) ) {			
			$var = 'http://localhost:8081/#/';			
		}else{
			$var = 'https://www.facilbak.cl/qr/#/';
		}
		return $var;
	}
}

if(!function_exists('iva'))
{    
	function iva()
	{
		return 19;
	}
}