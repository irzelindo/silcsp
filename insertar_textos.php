<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $_SESSION['nomtexto']=$_POST['nomtexto'];
   $_SESSION['eltexto']=$_POST['eltexto'];

   $codusu=$_SESSION['codusu'];      

   include("conexion.php");
   $conn=Conectarse();
			
   $nomtexto = trim($_POST['nomtexto']);
   $eltexto = trim($_POST['eltexto']);
	
   
    $nroreg1=0;

	$query2 = "select * from textos where nomtexto = '$nomtexto'";
    $result2 = pg_query($conn, $query2);
    $nroreg2=pg_num_rows($result2);

   $norden=0;
   $ultimoorden = pg_query("select codtexto from textos order by codtexto"); 
   while ($row = pg_fetch_assoc($ultimoorden))
	   {
	   $norden = $row['codtexto'];
	   }
	$norden=$norden+1;
    $codtexto=$norden;

    if ($nroreg1==0 && $nroreg2==0)
	   {
	 	$result = pg_query($conn, "insert into textos( codtexto, nomtexto, texto) values ($codtexto, '$nomtexto', '$eltexto')"); 
    	
		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_438";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Textos: Inserta-Reg.: ".$codtexto."-".$nomtexto;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: textos.php?mensage=9");
       }
	else
       {
        if ($nroreg1!=0)
           {
       		header("Location: nuevo_textos.php?mensage2=1"); 
           }
        if ($nroreg2!=0)
           {
       		header("Location: nuevo_textos.php?mensage2=2"); 
           }
       }
?>
