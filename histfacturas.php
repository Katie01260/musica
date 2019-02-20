<meta charset="utf-8">
<?php

include('config.php'); 
  session_start();
$customerId=$_SESSION['customerId'];


$sql_historialfacturas="select * from Invoice where CustomerId=$customerId;";
$result=mysqli_query($db, $sql_historialfacturas);

 
  
if (mysqli_num_rows($result) > 0) {
       echo "<table border=1";
       //recorre el resultado fila a fila 
          echo "<tr>";
          echo "<th>IdFactura</th>";
          echo "<th>IdCliente</th>";
          echo "<th>Fecha Factura</th>";
          echo "<th>Dirección de Envio</th>";
          echo "<th>Ciudad de Facturación</th>";
          echo "<th>Estado de Facturación</th>";
          echo "<th>País de Facturación</th>";
          echo "<th>CodPostal</th>";
          echo "<th>Total</th>";

          echo "</tr>";   
       while ($fila = mysqli_fetch_assoc($result)) {
          echo "<tr>";
            echo "<td>".$fila["InvoiceId"]."</td>";
            echo "<td>".$fila["CustomerId"]."</td>";
            echo "<td>".$fila["InvoiceDate"]."</td>";
            echo "<td>".$fila["BillingAddress"]."</td>";
            echo "<td>".$fila["BillingCity"]."</td>";  
            echo "<td>".$fila["BillingState"]."</td>";
            echo "<td>".$fila["BillingCountry"]."</td>";
            echo "<td>".$fila["BillingPostalCode"]."</td>"; 
            echo "<td>".$fila["Total"]."</td>";
          echo "</tr>";
        }
      echo "</table>";

      } 
      else {
        echo "No existe ese Id de Cliente";
      }     


?>
