<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $_SESSION['codantibiogr']=$_POST['codantibiogr'];
   $_SESSION['codantibiot']=$_POST['codantibiot'];
   $codusu=$_SESSION['codusu'];      

   include("conexion.php");
   $conn=Conectarse();
			
   $codantibiogr = trim($_POST['codantibiogr']);
   $codantibiot = trim($_POST['codantibiot']);
	
   
	$query1 = "select * from antibioticoantibiograma where codantibiogr = '$codantibiogr' and codantibiot = '$codantibiot'";
    $result1 = pg_query($conn, $query1);
    $nroreg1=pg_num_rows($result1); 

    $posicion=0;
    $ultimoorden = pg_query($conn,"select posicion from antibioticoantibiograma where codantibiogr = '$codantibiogr' order by posicion"); 
    while ($row = pg_fetch_array($ultimoorden))
	    {
	    $posicion = $row['posicion'];
	    }
    $posicion=$posicion+1;

    if ($nroreg1==0)
	   {
	 	$result = pg_query($conn, "insert into antibioticoantibiograma( codantibiogr, codantibiot, posicion) values ('$codantibiogr', '$codantibiot', $posicion)"); 
    	
		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_4315";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Antibiotico de Antibiogramas: Inserta-Reg.: ".$codantibiogr."-".$nomantibiogr.', Cod.Antibiotico: '.$codantibiot;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: modifica_antibiogramas.php?mensage=9&id=".$codantibiogr);
       }
	else
       {
   		header("Location: nuevo_antibioticosrel.php?mensage2=1&codantibiogr=$codantibiogr"); 
       }
?>
