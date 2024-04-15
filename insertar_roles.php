<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $_SESSION['codrol']=$_POST['codrol'];
   $_SESSION['nomrol']=$_POST['nomrol'];
   $_SESSION['estado']=$_POST['estado'];

   $_SESSION['permi']    = $_POST['permi'];
   
   $codusu=$_SESSION['codusu'];      

   include("conexion.php");
   $conn=Conectarse();

   $codrol = trim($_POST['codrol']);		
   $nomrol = trim($_POST['nomrol']);
   $estado = 1*$_POST['estado'];

   $vector    = $_POST['permi'];	
   
	$query1 = "select * from roles where codrol = '$codrol'"; 
    $result1 = pg_query($conn, $query1);
    $nroreg1=pg_num_rows($result1);

	$query2 = "select * from roles where nomrol = '$nomrol'";
    $result2 = pg_query($conn, $query2);
    $nroreg2=pg_num_rows($result2);

    if ($nroreg1==0 && $nroreg2==0)
	   {
	 	$result = pg_query($conn, "insert into roles( codrol, nomrol, estado) values ('$codrol', '$nomrol', $estado)"); 


            // Agregar registros en OPC_USUARIOS - Permisos
            $sql="select * from opciones ORDER BY codopc";
            $res=pg_query($conn, $sql);
            $i=0;
            while ($row = pg_fetch_assoc($res))
      	          {
                  $i=$i+1;
                  $valor=$vector[$i];
                  $codopc=$row['codopc'];
    	 	      $result = pg_query($conn,"insert into opcionroles( codrol,codopc,modo) values('$codrol','$codopc','$valor')");               
                  }
    	
		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_413";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Roles: Inserta-Reg.: ".$codrol."-".$nomrol;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: roles.php?mensage=9");
       }
	else
       {
        if ($nroreg1!=0)
           {
       		header("Location: nuevo_roles.php?mensage2=1"); 
           }
        if ($nroreg2!=0)
           {
       		header("Location: nuevo_roles.php?mensage2=2"); 
           }
       }
?>
