<?php

namespace Edukagames\UserBundle\Util;

class SaveFile
{
	/**
	 * @author Chema
	 * @example SaveFile::saveFile($raizImagen, $_FILES['Alumno_Perfil']['tmp_name']["foto"], $nombreArchivo);
	 * @param string $destination
	 * @param string $tmp_filename
	 * @param string $filename
	 * 
	 * @return NULL
	 */
    public static function saveFile($destination, $tmp_filename, $filename)
    {
    	if(!file_exists($destination)){
        	mkdir($destination, 0775);
    	}
        move_uploaded_file($tmp_filename, "$destination/$filename");
    }
}

?>