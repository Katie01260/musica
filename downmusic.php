<meta charset="utf-8">
<?php

include('config.php'); 
 session_start();
 $customerId=$_SESSION['customerId'];
 

insertarProducto($db,$customerId);


function insertarProducto($db,$customerId){

	$sql_listacanciones="select Name from Track order by Name;";
	$result=mysqli_query($db,$sql_listacanciones);

	echo '<form name="formulario" method="post" action="recogerdatos.php">';
	echo "<h2>Elegir canción</h2>";
					  
	echo "<select name='canciones'>";
	if (mysqli_num_rows($result) > 0) {
		while($fila = mysqli_fetch_assoc($result)) { 
			echo "<option>".$fila['Name']."</option>";
		}

	}

	echo "</select>"."<br><br>";
	echo "<input type = 'submit' value = ' Submit ' name='submit'/> ";
	echo "<input type = 'submit' value = ' Finalizar Compra ' name='finalizar'/><br />";
	echo "</form>";

	
	
	if(isset($_COOKIE['cancion'.$customerId])){
		$cont=0;
		//muestra la canciones del carrito
		$listacarrito=unserialize($_COOKIE['cancion'.$customerId]); //al desserializar pierde las claves que tenía
		/* print_r($listacarrito); */


			echo "<h2>Canciones añadidas al carrito</h2>";

			foreach ($listacarrito as $valor){
			
				foreach ($valor as $clave => $valor2){
					echo $valor2 . "   ";
					if($clave=='precio'){
						$cont=$cont+$valor2;
						/* echo "precio:".$valor2."<br>"; */
					}
					
				}
				
				echo "<br>";
			}  
			echo "totalcanciones: ".$cont;
	}
 

}






?>