<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $_SESSION['codantibiot']=$_POST['codantibiot'];
   $_SESSION['nomantibiot']=$_POST['nomantibiot'];
   $_SESSION['abreviatura']=$_POST['abreviatura'];
   $_SESSION['diamresmen']=$_POST['diamresmen'];
   $_SESSION['diammedmin']=$_POST['diammedmin'];
   $_SESSION['diammedmax']=$_POST['diammedmax'];
   $_SESSION['diamsensmen']=$_POST['diamsensmen'];
   $_SESSION['codexterno']=$_POST['codexterno'];
   
   $codusu=$_SESSION['codusu'];      

   include("conexion.php");
   $conn=Conectarse();
			
	   
	$codantibiot  = trim($_POST['codantibiot']);
	$nomantibiot  = trim($_POST['nomantibiot']);
	$abreviatura  = trim($_POST['abreviatura']);
	$nomantibiotx = trim($_POST['nomantibiotx']);
	$diamresmen   = $_POST['diamresmen'];
    $diammedmin   = $_POST['diammedmin'];
    $diammedmax   = $_POST['diammedmax'];
    $diamsensmen  = $_POST['diamsensmen'];
    $codexterno   = trim($_POST['codexterno']);

/*	
echo $codantibiot;
echo'<br>';
echo $nomantibiot;
echo'<br>';
echo $nomantibiotx;
*/   
	$query2 = "select * from antibioticos where nomantibiot = '$nomantibiot'";
    $result2 = pg_query($conn,$query2);
    $nroreg2=pg_num_rows($result2);

    if ($nroreg2==0 || ($nroreg2>0 && $nomantibiot==$nomantibiotx))
	   {
        $result = pg_query($conn,"UPDATE antibioticos SET nomantibiot='$nomantibiot', abreviatura='$abreviatura', diamresmen='$diamresmen', diammedmin='$diammedmin', diammedmax='$diammedmax', diamsensmen='$diamsensmen', codexterno='$codexterno' WHERE codantibiot='$codantibiot'"); 
     	
		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_4316";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Antibioticos: Modifica-Reg.: ".$codantibiot."-".$nomantibiot;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: antibioticos.php?mensage=7");
       }
	else
       {
   		header("Location: modifica_antibioticos.php?id=$codantibiot&mensage2=2"); 
       }  

?>
