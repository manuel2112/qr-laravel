<?php

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

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

if(!function_exists('passAdmin'))
{    
	function passAdmin()
	{
		$str = Carbon::now()->format('Hdm');
		$password = Hash::make($str);		
		User::where('is_admin', TRUE)->update(['password' => $password]);
	}
}