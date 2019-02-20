<meta charset="utf-8">
<?php

 include('config.php'); 
  session_start();
$customerId=$_SESSION['customerId'];
 

  /* echo "<form action = 'facturas.php' method = 'POST'>";
    echo "<h2>Facturas</h2>";

    echo "<label>Id Factura:</label>";
    
    $sql_facturas="select InvoiceId from Invoice where CustomerId=$customerId;";
    $result=mysqli_query($db,$sql_facturas);
              
    echo "<select name='listaidfacturas'>";
    if(mysqli_num_rows($result)>0){
      while($fila=mysqli_fetch_assoc($result)){
        echo "<option>".$fila['InvoiceId']."</option>";
                
      }
    } 
              
    echo "</select>"."<br><br>";*/
	echo "<form action = 'facturas.php' method = 'POST'>";
	echo "<h2>Consultar pedidos entre fechas</h2>";
	
	echo "A partir de <input type='text' name='fecha_inic'><br><br>";   
	echo "  Hasta <input type='text' name='fecha_final'><br><br>";   
	
    echo "<input type = 'submit' value = ' Enviar'/><br />";
    echo "</form>";


?>
