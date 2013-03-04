<?php

namespace Edukagames\UserBundle\Util;

class SaveEraseFile
{
	/**
	 * @author Chema
	 * @example SaveEraseFile::saveFile($raizImagen, $_FILES['Alumno_Perfil']['tmp_name']["foto"], $nombreArchivo);
	 * @param string $destination
	 * @param string $tmp_filename
	 * @param string $filename
	 * 
	 * @return NULL
	 */
    public static function saveFile($destination, $tmp_filename, $filename)
    {
    	if(!file_exists($destination)){
        	mkdir($destination, 0755 ,true);
    	}
        move_uploaded_file($tmp_filename, "$destination/$filename");
    }
    
    public static function eraseFile($dir)
    {
    	if ( !is_dir($dir))
    		if (file_exists($dir))
    			unlink($dir);
    }
    
    public static function eraseDir($dir) 
    {
    	if(file_exists($dir)){
    		foreach(glob($dir . '/*') as $file) {
    			if(is_dir($file))
    				eraseDir($file);
    			else
    				unlink($file);
    		}
    		rmdir($dir);
    	}

    }

}

?>