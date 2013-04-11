<?php 
    $host = 'localhost';
	$user = 'edukagames';
	$pass = 'edukagames';
	$db = 'edukagames';
	
    $database = mysql_connect($host, $user, $pass) or die('No se puede conectar: ' . mysql_error());
    mysql_select_db($db) or die('No se pudo seleccionar una base de datos.');
 
    // Strings must be escaped to prevent SQL injection attack.
    $id_alumno = mysql_real_escape_string($_GET['id_alumno']);
    $id_juego = mysql_real_escape_string($_GET['id_juego']);
    $hash = mysql_real_escape_string($_GET['hash']);
    $secretKey="EfectoStroop"; # Change this value to match the value stored in the client javascript below 

    $real_hash = md5($id_alumno.$id_juego.$secretKey); 
    if($real_hash == $hash) { 
        // Send variables for the MySQL database class. 
        $query = "SELECT MAX( `Puntos` ) FROM `puntuacion` WHERE `Alumno_id` = '$id_alumno' AND `Juego_id`= '$id_juego'"; 
        $result = mysql_query($query) or die('Query failed: ' . mysql_error());
		echo (mysql_fetch_array($result)[0]);
    }
?>