<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $_SESSION['nroorden']=$_POST['nroorden'];
   $_SESSION['dia']=$_POST['dia'];
   $_SESSION['mes']=$_POST['mes'];
   $_SESSION['anio']=$_POST['anio'];
   $_SESSION['esanual']=$_POST['esanual'];
   $_SESSION['motivo']=$_POST['motivo'];

   $codusu=$_SESSION['codusu'];      

   include("conexion.php");
   $conn=Conectarse();


   $dia=1*$_POST['dia'];
   $mes=1*$_POST['mes'];
   $anio=1*$_POST['anio'];
   $esanual = 1*$_POST['esanual'];
   $motivo = trim($_POST['motivo']);
	
   $nroorden=0;
   $ultimoorden = pg_query("select nroorden from feriados order by nroorden"); 
   while ($row = pg_fetch_assoc($ultimoorden))
	   {
	   $nroorden = $row['nroorden'];
	   }
	$nroorden=$nroorden+1;
	
   
    $nroreg1=0; 

    $nroreg2=0;

    if ($nroreg1==0 && $nroreg2==0)
	   {
	 	$result = pg_query($conn, "insert into feriados( nroorden, dia, mes, anio, esanual, motivo) values ('$nroorden', '$dia', '$mes', '$anio', $esanual, '$motivo')"); 
    	
		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_4113";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Feriados y Asuetos: Inserta-Reg.: ".$nroorden."-".$dia;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: feriados.php?mensage=9");
       }
	else
       {
        if ($nroreg1!=0)
           {
       		header("Location: nuevo_feriados.php?mensage2=1"); 
           }
        if ($nroreg2!=0)
           {
       		header("Location: nuevo_feriados.php?mensage2=2"); 
           }
       }
?>
