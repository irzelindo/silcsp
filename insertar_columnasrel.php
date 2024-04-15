<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $_SESSION['codplatilla']=$_POST['codplatilla'];
   $_SESSION['columna']=$_POST['columna'];
   $codusu=$_SESSION['codusu'];      

   include("conexion.php");
   $conn=Conectarse();
			
   $codplatilla = trim($_POST['codplatilla']);
   $columna = trim($_POST['columna']);
	
   
	$query1 = "select * from plantillaplandet where codplatilla = '$codplatilla' and columna = '$columna'";
    $result1 = pg_query($conn, $query1);
    $nroreg1=pg_num_rows($result1); 

    $posicion=0;
    $ultimoorden = pg_query($conn,"select posicion from plantillaplandet where codplatilla = '$codplatilla' order by posicion"); 
    while ($row = pg_fetch_array($ultimoorden))
	    {
	    $posicion = $row['posicion'];
	    }
    $posicion=$posicion+1;

    if ($nroreg1==0)
	   {
	 	$result = pg_query($conn, "insert into plantillaplandet( codplatilla, columna, posicion) values ('$codplatilla', '$columna', $posicion)"); 
    	
		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_4318";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Columnas de plantillas: Inserta-Reg.: ".$codplatilla."-".', Columna: '.$columna;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: modifica_plantillas_plan_trabajo.php?mensage=9&id=".$codplatilla);
       }
	else
       {
   		header("Location: nuevo_columnasrel.php?mensage2=1&codplatilla=$codplatilla"); 
       }
?>
