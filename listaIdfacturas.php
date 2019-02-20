<meta charset="utf-8">
<?php

include('config.php'); 
 session_start();

 $idfactura=$_POST['listaidfacturas'];
 
 $consultafactura="select * from InvoiceLine where InvoiceId=$idfactura;";
	
	$result=mysqli_query($db,$consultafactura);

	if (mysqli_num_rows($result) > 0) {
       echo "<table border=1";
       //recorre el resultado fila a fila 
          echo "<tr>";
          echo "<th>Id Linea Factura</th>";
          echo "<th>Id factura</th>";
          echo "<th>Id canción</th>";
          echo "<th>Precio Unidad</th>";
          echo "<th>Cantidad</th>";
          echo "</tr>";   
		  
       while ($fila = mysqli_fetch_assoc($result)) {
          echo "<tr>";
            echo "<td>".$fila["InvoiceLineId"]."</td>";
            echo "<td>".$fila["InvoiceId"]."</td>";
            echo "<td>".$fila["TrackId"]."</td>";
            echo "<td>".$fila["UnitPrice"]."</td>";
            echo "<td>".$fila["Quantity"]."</td>";  
            echo "</tr>";
        }
      echo "</table>";

      } 
      else {
        echo "No existe ese Id de Cliente";
      }     
 

?>