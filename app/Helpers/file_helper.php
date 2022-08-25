<?php

if(!function_exists('createDir'))
{
	function createDir($directorio)
	{
        if (!file_exists($directorio)) {
            mkdir($directorio, 0777, true);
        }
	}
}