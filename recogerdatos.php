<meta charset="utf-8">
<?php

include('config.php'); 
 session_start();

// $cookie_name="cancion";
//  setcookie($cookie_name, $_COOKIE[$cookie_name], time() + 365 * 24 * 60 * 60); 

$customerId=$_SESSION['customerId'];
$cancion=$_POST['canciones'];//recibo la cancion

$precio=sacarPrecio($db, $cancion);

if(isset($_POST['submit'])){

	$carritocanciones=array();  /* $miarray=array(0 => array('maria', 'pepe' ,'juan')); */
	if(isset($_COOKIE['cancion'.$customerId])){ //si existe la cookie tengo que añadir la cancion pero como el valor de la cookie está en string lo convierto en array
		$posic=count(unserialize($_COOKIE['cancion'.$customerId]));
		echo "posic".$posic;
		 
		$arraycarritocanciones=unserialize($_COOKIE['cancion'.$customerId]); //convierto string a array
		
		//añadir dos valores array asoc ya creado  cambiado --array('cancion'=> $cancion, 'precio'=> $precio
		$arraycarritocanciones[]=array( 'cancion'=> $cancion, 'precio'=> $precio );
		
		setcookie('cancion'.$customerId, serialize($arraycarritocanciones), time() + 365 * 24 * 60 * 60); //convierto array con nueva cancion en string
		echo $cancion . " añadida al carrito<br>";

	}
	else{ //no existe la cookie
		/* array_push($carritocanciones,$cancion); */
		$carritocanciones=array( 0 => array('cancion'=> $cancion, 'precio'=> $precio) ); 
		setcookie('cancion'.$customerId, serialize($carritocanciones), time() + 365 * 24 * 60 * 60); //crea la cookie y su valor es array $carritocanciones en string
		
		echo $cancion . " añadida al carrito<br>";
		
	}

	header ("location:downmusic.php"); 

}

if(isset($_POST['finalizar'])){

	echo '<form name="form-datosinvoice" method="post" action="recogerdatosinvoice.php">';
	echo "<h2>Datos de facturación</h2>";
	echo "Dirección de facturación: <input type='text' name='dirfacturacion' ><br>";
	echo "Ciudad <input type='text' name='ciudad' ><br>";
	echo "Estado <input type='text' name='estado' ><br>";				
	echo "País <input type='text' name='pais'  ><br>";
	echo "Código Postal <input type='text' name='codpostal'  ><br>";
	
	echo "<input type = 'submit' value = ' Enviar ' name='finalizar'/><br />";
	echo "</form>";

}
 

 function sacarPrecio($db, $cancion){
	$sql_sacarprecio="select UnitPrice from track where name='$cancion';";
	$result=mysqli_query($db, $sql_sacarprecio);

	if (mysqli_num_rows($result) > 0) {
		while($fila = mysqli_fetch_assoc($result)) { 
			$precio=$fila['UnitPrice'];
		}

	}
	
	return $precio;
 }



?>