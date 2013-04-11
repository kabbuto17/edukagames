
<?php 
    $host = 'localhost';
	$user = 'edukagames';
	$pass = 'edukagames';
	$db = 'edukagames';
	
    $database = mysql_connect($host, $user, $pass) or die('No se puede conectar: ' . mysql_error());
    mysql_select_db($db) or die('No se pudo seleccionar una base de datos.');
 
    // Strings must be escaped to prevent SQL injection attack.
    $username = mysql_real_escape_string($_GET['username']); 
  	$hash = mysql_real_escape_string($_GET['hash']); 
    $secretKey="EfectoStroop"; # Change this value to match the value stored in the client javascript below 

    $real_hash = md5($username.$secretKey); 
    if($real_hash == $hash) { 
        // Send variables for the MySQL database class. 
        $query = "SELECT `alumno`.`id`, `alumno`.`password`, `alumno`.`nombreCompleto`, `alumno`.`salt`, `juego`.`id` 
        FROM `alumno`, `juego` WHERE `userName` = '$username' AND `juego`.`nombre` = 'Efecto Stroop'";
        $result = mysql_query($query) or die('Query failed: ' . mysql_error());
		$result = mysql_fetch_array($result);
		echo $result[0].":".$result[1].":".$result[2].":".$result[3].":".$result[4];
    } 
?>