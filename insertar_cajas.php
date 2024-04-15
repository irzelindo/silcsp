<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $_SESSION['codcaja']=$_POST['codcaja'];
   $_SESSION['nomcaja']=$_POST['nomcaja'];
   $_SESSION['codservicio']=$_POST['codservicio'];
   $_SESSION['codusuc']=$_POST['codusuc'];
   $_SESSION['region']=$_POST['region'];

   $codusu=$_SESSION['codusu'];      

   include("conexion.php");
   $conn=Conectarse();

   $codcaja = $_POST['codcaja'];		
   $nomcaja = trim($_POST['nomcaja']);
   $codservicio = $_POST['codservicio'];
   $codusuc = $_POST['codusuc'];
   $region = $_POST['region'];

/*echo '<br> codcaja: '.$codcaja;
echo '<br> nomcaja: '.$nomcaja;
echo '<br> codservicio: '.$codservicio;
echo '<br> region:'.$region;
*/
   
	$query1 = "select * from cajas where codcaja = '$codcaja'  and codservicio='$codservicio'";
    $result1 = pg_query($conn, $query1);
    $nroreg1=pg_num_rows($result1);

	$query2 = "select * from cajas where nomcaja = '$nomcaja'  and codservicio='$codservicio'";
    $result2 = pg_query($conn, $query2);
    $nroreg2=pg_num_rows($result2);

    if ($nroreg1==0 && $nroreg2==0)
	   {
	 	$result = pg_query($conn, "insert into cajas( codcaja, nomcaja, codservicio, codusu) values ('$codcaja', '$nomcaja', '$codservicio', '$codusuc')"); 
    	
		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_443";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Cajas: Inserta-Reg.: ".$codcaja."-".$nomcaja.", Servicio: ".$codservicio;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: cajas.php?mensage=9");
       }
	else
       {
        if ($nroreg1!=0)
           {
       		header("Location: nuevo_cajas.php?mensage2=1"); 
           }
        if ($nroreg2!=0)
           {
       		header("Location: nuevo_cajas.php?mensage2=2"); 
           }
       }
?>
