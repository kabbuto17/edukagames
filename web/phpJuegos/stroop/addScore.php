<?php
    $host = 'localhost';
	$user = 'edukagames';
	$pass = 'edukagames';
	$db = 'edukagames';
	
    $database = mysql_connect($host, $user, $pass) or die('No se puede conectar: ' . mysql_error());
    mysql_select_db($db) or die('No se pudo seleccionar una base de datos.');

    // Strings must be escaped to prevent SQL injection attack.
    $puntos = mysql_real_escape_string($_GET['puntos']);
    $dificultad = mysql_real_escape_string($_GET['dificultad']);
    $aciertos = mysql_real_escape_string($_GET['aciertos']);
    $fallos = mysql_real_escape_string($_GET['fallos']);
    $id_juego = mysql_real_escape_string($_GET['id_juego']);
    $id_alumno = mysql_real_escape_string($_GET['id_alumno']);
    $hash = mysql_real_escape_string($_GET['hash']);
    $date = mysql_real_escape_string($_GET['date']);
    
    $secretKey="EfectoStroop";
    $real_hash = md5($puntos.$dificultad.$aciertos.$fallos.$date.$id_juego.$id_alumno.$secretKey); //falta date
    if($real_hash == $hash) { 
        // Send variables for the MySQL database class.
        $query = "INSERT INTO `edukagames`.`puntuacion`". 
        "(`id`, `Puntos`, `Dificultad`, `Aciertos`, `Fallos`, `Tiempo`, `fecha`, `Juego_id`, `Alumno_id`)".
        "VALUES (NULL, '$puntos', '$dificultad', '$aciertos', '$fallos', NULL, '$date', '$id_juego', '$id_alumno')";
        $result = mysql_query($query) or die('Query failed: ' . mysql_error());
		echo 1;
    }

?>