<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $_SESSION['respuesta']=$_POST['respuesta'];
   $_SESSION['textopregunta']=$_POST['textopregunta'];

   $codusu=$_SESSION['codusu'];      

   include("conexion.php");
   $conn=Conectarse();
			
   $respuesta = trim($_POST['respuesta']);
   $textopregunta = trim($_POST['textopregunta']);
	
   
    $nroreg1=0;
    $nroreg2=0; 

   $norden=0;
   $ultimoorden = pg_query("select nropregunta from preguntaedcontinua order by nropregunta"); 
   while ($row = pg_fetch_assoc($ultimoorden))
	   {
	   $norden = $row['nropregunta'];
	   }
	$norden=$norden+1;
    $nropregunta=$norden;

    if ($nroreg1==0 && $nroreg2==0)
	   {
	 	$result = pg_query($conn, "insert into preguntaedcontinua( nropregunta, respuesta, textopregunta, puntaje, tipo) values ($nropregunta, '$respuesta', '$textopregunta')"); 
    	
		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_451";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Preguntas de educacion continua: Inserta-Reg.: ".$nropregunta."-".$respuesta;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: educacion_continua.php?mensage=9");
       }
	else
       {
        if ($nroreg1!=0)
           {
       		header("Location: nuevo_educacion_continua.php?mensage2=1"); 
           }
        if ($nroreg2!=0)
           {
       		header("Location: nuevo_educacion_continua.php?mensage2=2"); 
           }
       }
?>
