<?php
	include("config.php"); 
  session_start();
  
   if($_SERVER["REQUEST_METHOD"] == "POST") {
	//para validar username=email passcode=lastname
      $myusername = mysqli_real_escape_string($db,$_POST['username']); //va el email
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); //va el last_name
      
      $sql = "SELECT Email, LastName, CustomerId  FROM Customer WHERE Email = '$myusername' and LastName = '$mypassword';";
      $result = mysqli_query($db,$sql);/* SELECT * FROM Customer WHERE Email = 'luisg@embraer.com.br' and LastName = 'Goncalves'; 
														astrid.gruber@apple.at Gruber*/
     
      $count = mysqli_num_rows($result);

	 $username=$_SESSION['login_user']."<br>";
		  
      if($count == 1) {
  echo "entra";
         $_SESSION['login_user'] = $myusername;
		
		
			while($fila = mysqli_fetch_assoc($result)) {
			
				$usuario=$fila["Email"];
				$customerId=$fila["CustomerId"];
			    echo "numempleado ".$usuario;	
			}
		 $_SESSION['customerId']=$customerId;

		/* $_SESSION['numempleado']=$numempleado; */
	
		header("location: welcome.php"); 
					
		}			
  
    else{
			 $error = "Tu nombre de usuario o password es invalido";
			 echo $error;
			 /*hacer que no ejecute el html*/
		}
   
   
   }
   
  
?>
<html>
   
   <head>
      <title>Login Page</title>
      
      <style type = "text/css">
         body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
         }
         label {
            font-weight:bold;
            width:100px;
            font-size:14px;
         }
         .box {
            border:#666666 solid 1px;
         }
      </style>
      
   </head>
   
   <body bgcolor = "#FFFFFF">
	
      <div align = "center">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>
				
            <div style = "margin:30px">
               
               <form action = " " method = "POST">
                  <label>Username  :</label>
				  <input type = "text" name = "username" class = "box"/><br /><br />
                  <label>Password  :</label>
				  <input type = "password" name = "password" class = "box" /><br/><br />
                  <input type = "submit" value = " Submit "/><br />
               </form>
               
               <div style = "font-size:11px; color:#cc0000; margin-top:10px"></div>
					
            </div>
				
         </div>
			
      </div>

   </body>
</html>