<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $_SESSION['codplatilla']=$_POST['codplatilla'];
   $_SESSION['columna']=$_POST['columna'];
   $_SESSION['posicion']=$_POST['posicion'];
   $_SESSION['columnax']=$_POST['columnax'];

   $codusu=$_SESSION['codusu'];      

   include("conexion.php");
   $conn=Conectarse();
			
   $codplatilla = trim($_POST['codplatilla']);
   $posicion = trim($_POST['posicion']);
   $columna = trim($_POST['columna']);
   $columnax = trim($_POST['columnax']);
	
   
	$query1 = "select * from plantillaplandet where codplatilla = '$codplatilla' and columna = '$columna'";
    $result1 = pg_query($conn, $query1);
    $nroreg1=pg_num_rows($result1); 


    if ($nroreg1==0 || ($nroreg1>0 && $columna==$columnax))
	   {
	 	$result = pg_query($conn, "UPDATE plantillaplandet set columna='$columna' 
                                           where codplatilla = '$codplatilla' and posicion = '$posicion'"); 
    	
		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_4318";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Columnas de plantillas: Modifica-Reg.: ".$codplatilla.', Columna: '.$columnax;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: modifica_plantillas_plan_trabajo.php?mensage=7&id=".$codplatilla);
       }
	else
       {
   		header("Location: modifica_columnasrel.php?mensage2=1&codplatilla=$codplatilla&posicion=$posicion"); 
       }
?>
