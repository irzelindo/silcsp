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
				   
	$codrol  = trim($_POST['codrol']);
	$nomrol  = trim($_POST['nomrol']);
	$estado  = 1*$_POST['estado'];
	$nomrolx = trim($_POST['nomrolx']);

    $vector    = $_POST['permi'];
/*	
echo $codrol;
echo'<br>';
echo $nomrol;
echo'<br>';
echo $nomrolx;
*/   
	$query2 = "select * from roles where nomrol = '$nomrol'";
    $result2 = pg_query($conn,$query2); 
    $nroreg2=pg_num_rows($result2);

    if ($nroreg2==0 || ($nroreg2>0 && $nomrol==$nomrolx))
	   {
        $result = pg_query($conn,"UPDATE roles SET nomrol='$nomrol', estado=$estado WHERE codrol='$codrol' "); 


    	pg_query($conn,"DELETE FROM opcionroles WHERE codrol = '$codrol'");

        // Agregar registros en OPC_USUARIOS - Permisos
        $sql="select * from opciones ORDER BY codopc";
        $res=pg_query($conn,$sql);
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
        $accion="Roles: Modifica-Reg.: ".$codrol."-".$nomrol;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: roles.php?mensage=7");
       }
	else
       {
   		header("Location: modifica_roles.php?id=$codrol&mensage2=2"); 
       }  
?>
