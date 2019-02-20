<meta charset="utf-8">
<?php

 include('config.php'); 
  session_start();
$customerId=$_SESSION['customerId'];

/* $idfactura=$_POST['listaidfacturas']; */
/* $sql_factura="select * from InvoiceLine where InvoiceId=$idfactura;";
$result=mysqli_query($db, $sql_factura); */

	$fecha_inic=$_REQUEST['fecha_inic'];
	$fecha_final=$_REQUEST['fecha_final'];
	
	/* function errores($error_level,$error_message) {
	echo "<b>ERROR:<br>". "Codigo de error:</b>$error_level<b><br>
	Mensaje: $error_message</b><br>";
} 
	set_error_handler("errores"); */
	
	
	
	if($fecha_inic==null AND $fecha_final==null){
		trigger_error("Introduce la fecha de inicio");
	
	}
	else if($fecha_inic==null){
		trigger_error("Introduce la Fecha de inicio");
	
	}
	else if($fecha_inic!=null AND $fecha_final==null){
		$sql= "select InvoiceId from Invoice where CustomerId=$customerId and InvoiceDate BETWEEN '$fecha_inic' AND now();";
					
	listaIdfactura($db,$sql);
	
	}
	else {
	
	$sql1= "select * from InvoiceId where CustomerId=$customerId and InvoiceDate BETWEEN '$fecha_inic' AND '$fecha_final';";

	listaIdfactura($db,$sql1);
	}				
	
	function listaIdfactura($db,$sqlejec){
		$result = mysqli_query($db, $sqlejec);
		
		echo "<form action = 'listaIdfacturas.php' method = 'POST'>";
		echo "<h2>Facturas</h2>";

		echo "<label>Id Factura:</label>";
		
		echo "<select name='listaidfacturas'>";
		if(mysqli_num_rows($result)>0){
		  while($fila=mysqli_fetch_assoc($result)){
			echo "<option>".$fila['InvoiceId']."</option>";
					
		  }
		} 
		echo "</select>";
		 echo "<input type = 'submit' value = ' Enviar'/><br />";
		echo "</form>";
	
	
	}
	
	
	
	
	
	
	
	
	
	
	
 

?>
