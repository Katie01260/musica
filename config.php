<?php
//para iniciar la base de datos
   define('DB_SERVER', '10.130.4.15');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', 'rootroot');
   define('DB_DATABASE', 'musica');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
  
   if (!$db) {
		die("Error conexión: " . mysqli_connect_error());
		}

  
?>
