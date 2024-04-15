<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $_SESSION['codmetodo']=$_POST['codmetodo'];
   $_SESSION['nommetodo']=$_POST['nommetodo'];


   $codusu=$_SESSION['codusu'];      

   include("conexion.php");
   $conn=Conectarse();

   $codmetodo = trim($_POST['codmetodo']);		
   $nommetodo = trim($_POST['nommetodo']);

	   
	$query1 = "select * from metodos where codmetodo = '$codmetodo'";
    $result1 = pg_query($conn, $query1);
    $nroreg1=pg_num_rows($result1);

	$query2 = "select * from metodos where nommetodo = '$nommetodo'";
    $result2 = pg_query($conn, $query2);
    $nroreg2=pg_num_rows($result2);

    if ($nroreg1==0 && $nroreg2==0)
	   {
	 	$result = pg_query($conn, "insert into metodos( codmetodo, nommetodo) values ('$codmetodo', '$nommetodo')"); 
    	
		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_436";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Metodos: Inserta-Reg.: ".$codmetodo."-".$nommetodo;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: metodos.php?mensage=9");
       }
	else
       {
        if ($nroreg1!=0)
           {
       		header("Location: nuevo_metodos.php?mensage2=1"); 
           }
        if ($nroreg2!=0)
           {
       		header("Location: nuevo_metodos.php?mensage2=2"); 
           }
       }
?>
