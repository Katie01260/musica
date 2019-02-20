<meta charset="utf-8">
<?php
include("config.php"); 
session_start();
$customerId=$_SESSION['customerId'];

$dirfacturacion=$_POST['dirfacturacion'];
$ciudad=$_POST['ciudad'];
$estado=$_POST['estado']; 
$pais=$_POST['pais'];
$codpostal=$_POST['codpostal'];

/* echo $dirfacturacion."<br>";
echo $ciudad."<br>";
echo $estado."<br>";
echo $pais."<br>";
echo $codpostal."<br>";  */


//si el cliente hace clic en Finalizar Compra que haga el insert en la tabla Invoice
insertarenInvoice($db,$customerId,$dirfacturacion, $ciudad, $estado, $pais, $codpostal);

function insertarenInvoice($db,$customerId,$dirfacturacion, $ciudad, $estado, $pais, $codpostal){

	$invoiceId=generarmaxInvoiceId($db,$customerId);
	
	$totalcarrito=totalpreciocarrito($customerId);

	$sql_insertar="insert into Invoice (InvoiceId, CustomerId, InvoiceDate, BillingAddress,BillingCity, BillingState, BillingCountry, BillingPostalCode, Total) 
	values ( $invoiceId, $customerId, now(),'$dirfacturacion', '$ciudad' , '$estado', '$pais', '$codpostal',$totalcarrito );";
	
	 if (mysqli_query($db, $sql_insertar)) {
			echo " Se ha dado insertado correctamente en tabla Invoice"."<br>";
		} else {
			echo " Error no se ha podido insertar correctamente en tabla Invoice<br>". mysqli_error($db);
		} 
		
	$listacarrito=unserialize($_COOKIE['cancion'.$customerId]); 


	foreach ($listacarrito as $valor) {
		$song=$valor['cancion'];
		$price=$valor['precio'];
	
		inserttablaInvoiceLine($db,$invoiceId,generarmaxInvoiceIdLine($db,$invoiceId),sacaridcancion($db,$song),$price,1); 
		
	}


 }  
/*  delete from Invoice where InvoiceId=413 and CustomerId=1; */

function inserttablaInvoiceLine($db,$invoiceId,$invoicelineId,$idcancion,$preciounidad,$cantidad){

	$sql_insertartabla="insert into InvoiceLine values ($invoicelineId, $invoiceId,$idcancion,$preciounidad,$cantidad);";


	if (mysqli_query($db, $sql_insertartabla)) {
			echo " Se ha dado insertado correctamente en tabla InvoiceLine"."<br>";
		} else {
			echo " Error no se ha podido insertar correctamente en tabla InvoiceLine<br>". mysqli_error($db);
		}


} 
	
function generarmaxInvoiceId($db,$customerId){
	$sql_crearinvoiceid="select max(InvoiceId)+1 from Invoice;";
	
	$result=mysqli_query($db,$sql_crearinvoiceid);

	if (mysqli_num_rows($result) > 0) {
		while($fila = mysqli_fetch_assoc($result)) { 
			$invoiceId=$fila['max(InvoiceId)+1'];
		}
		return $invoiceId;
	}


}

function generarmaxInvoiceIdLine($db,$invoiceId){
	$sql_crearinvoicelineid="select max(InvoiceLineId)+1 from InvoiceLine;";
	$result=mysqli_query($db,$sql_crearinvoicelineid);

	if (mysqli_num_rows($result) > 0) {
		while($fila = mysqli_fetch_assoc($result)) { 
			$invoicelineId=$fila['max(InvoiceLineId)+1'];
		}
		return $invoicelineId;
	}


}

function sacaridcancion($db,$cancion){
	echo "cancion".$cancion;
	$sql_sacaridcancion="select trackId from track where name='$cancion';";
	$result=mysqli_query($db,$sql_sacaridcancion);

	if (mysqli_num_rows($result) > 0) {
		while($fila = mysqli_fetch_assoc($result)) { 
			$idcancion=$fila['trackId'];
		}

	}

return $idcancion;

}


function totalpreciocarrito($customerId){
	// $arraycanciones=array();

	if(isset($_COOKIE['cancion'.$customerId])){
			$total=0;
			//muestra la canciones del carrito
			$listacarrito=unserialize($_COOKIE['cancion'.$customerId]); //al desserializar pierde las claves que tenía

				foreach ($listacarrito as $valor){
					foreach ($valor as $clave => $valor2){
				
						if($clave=='precio'){
							$total=$total+$valor2;
						}
						
					} 

				} 
	}
	
	return $total;

}






?>
