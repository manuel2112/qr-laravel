<?php

if(!function_exists('logCron'))
{
	function logCron($file,$texto)
	{        
        $directorio = public_path('uploads/txt/cron/');
        createDir($directorio);	
		$texto 		= $texto;
		// $texto 		= $texto.PHP_EOL;
        $ruta 		= $directorio . $file;
		$myfile     = fopen($ruta, "a+") or die("Unable to open file!");
		fwrite($myfile, $texto);
		fclose($myfile);
	}
}

if(!function_exists('logCompra'))
{
	function logCompra($orden,$texto)
	{
		$directorio = public_path('uploads/txt/buy/');
		createDir($directorio);
		$ruta 		= $directorio . "log_". $orden .".txt";
		$myfile     = fopen($ruta, "a+") or die("Unable to open file!");
		fwrite($myfile, $texto);
		fclose($myfile);
	}
}