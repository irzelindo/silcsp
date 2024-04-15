<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $_SESSION['coddetermina']=$_POST['coddetermina'];
   $_SESSION['codresultado']=$_POST['codresultado'];
  
   
   $codusu=$_SESSION['codusu'];      

   include("conexion.php");
   $conn=Conectarse();
			
   $coddetermina = $_POST['coddetermina'];
   $codresultado = $_POST['codresultado'];
  
   
	$query1 = "select * from resultadoposiblemaster where coddetermina = '$coddetermina' and codresultado = '$codresultado'";
    $result1 = pg_query($conn, $query1);
    $nroreg1=pg_num_rows($result1); 

    if ($nroreg1==0)
	   {
	 	$result = pg_query($conn, "insert into resultadoposiblemaster( coddetermina, codresultado) values ('$coddetermina', '$codresultado')"); 
    	
        // ---------------- Ahora afecto a todos los estudios con esta determinacion ----------------//

        $sql1 = "select * from determinaciones where coddetermina='$coddetermina' order by codestudio ";
	    $res1=pg_query($conn,$sql1);
        while ($row2 = pg_fetch_array($res1))
	         {
	          $codestudio=$row2[codestudio];
              
             $result1 = pg_query($conn, "insert into resultadoposible( codestudio, coddetermina, codresultado) values ('$codestudio', '$coddetermina', '$codresultado')");
	         }        
        
        
		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_433";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Respuestas de Determinaciones: Inserta-Reg.: ".$coddetermina.', Posicion: '.$codresultado;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: modifica_determinaciones.php?mensage=9&id=".$coddetermina."#grilla2");
       }
	else
       {
   		header("Location: nuevo_respuestasrel.php?mensage2=1&coddetermina=$coddetermina"); 
       }
?>
