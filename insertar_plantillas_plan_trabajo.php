<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $_SESSION['codplatilla']=$_POST['codplatilla'];
   $_SESSION['nomplatilla']=$_POST['nomplatilla'];
   $codusu=$_SESSION['codusu'];      

   include("conexion.php");
   $conn=Conectarse();
			
   $codplatilla = trim($_POST['codplatilla']);
   $nomplatilla = trim($_POST['nomplatilla']);
	
   
	$query1 = "select * from plantillaplan where codplatilla = '$codplatilla'";
    $result1 = pg_query($conn, $query1);
    $nroreg1=pg_num_rows($result1);

	$query2 = "select * from plantillaplan where nomplatilla = '$nomplatilla'";
    $result2 = pg_query($conn, $query2);
    $nroreg2=pg_num_rows($result2);

    if ($nroreg1==0 && $nroreg2==0)
	   {
	 	$result = pg_query($conn, "insert into plantillaplan( codplatilla, nomplatilla) values ('$codplatilla', '$nomplatilla')"); 
    	
		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_4318";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Plantillas de Planes de Trabajo: Inserta-Reg.: ".$codplatilla."-".$nomplatilla;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: modifica_plantillas_plan_trabajo.php?id=".$codplatilla);
       }
	else
       {
        if ($nroreg1!=0)
           {
       		header("Location: nuevo_plantillas_plan_trabajo.php?mensage2=1"); 
           }
        if ($nroreg2!=0)
           {
       		header("Location: nuevo_plantillas_plan_trabajo.php?mensage2=2"); 
           }
       }
?>
