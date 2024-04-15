<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $_SESSION['coddetermina']=$_POST['coddetermina'];
   $_SESSION['tipo']=$_POST['tipo'];

   $_SESSION['sexo']       = $_POST['sexo'];
   $_SESSION['edadmin']    = $_POST['edadmin'];
   $_SESSION['edadmax']    = $_POST['edadmax'];
   $_SESSION['tipoedad']    = $_POST['tipoedad'];
   $_SESSION['inirango']    = $_POST['inirango'];
   $_SESSION['finrango']    = $_POST['finrango'];
   $_SESSION['codresultado1']    = $_POST['codresultado1'];
   $_SESSION['codresultado2']    = $_POST['codresultado2'];
   $_SESSION['codresultado3']    = $_POST['codresultado3'];  
   $_SESSION['generico']    = $_POST['generico']; 
   $codusu=$_SESSION['codusu'];      

   include("conexion.php");
   $conn=Conectarse();
			
   $coddetermina = trim($_POST['coddetermina']);
   $tipo = 1*$_POST['tipo'];
   $tipox = $tipo;

   $sexo       = 1*$_POST['sexo'];
   $edadmin    = 1*$_POST['edadmin'];
   $edadmax    = 1*$_POST['edadmax'];
   $tipoedad    = 1*$_POST['tipoedad'];
   $inirango    = 1*$_POST['inirango'];
   $finrango    = 1*$_POST['finrango'];
   $codresultado1    = $_POST['codresultado1'];
   $codresultado2    = $_POST['codresultado2'];
   $codresultado3    = $_POST['codresultado3'];	
   $generico    = $_POST['generico']; 
   
/*	$query1 = "select * from determinacionrangomaster where coddetermina = '$coddetermina' and tipo = $tipo";
    $result1 = pg_query($conn, $query1);
    $nroreg1=pg_num_rows($result1); */
    $nroreg1=0;

    if ($nroreg1==0 || ($nroreg1>0 && $tipo==$tipox))
	   {
	 	$result = pg_query($conn, "UPDATE determinacionrangomaster set sexo=$sexo, 
                                                                       edadmin=$edadmin, 
                                                                       edadmax=$edadmax, 
                                                                       tipoedad=$tipoedad, 
                                                                       inirango=$inirango, 
                                                                       finrango=$finrango, 
                                                                       codresultado1='$codresultado1', 
                                                                       codresultado2='$codresultado2', 
                                                                       codresultado3='$codresultado3' 
                                           where coddetermina = '$coddetermina' and tipo = '$tipox'"); 

        // ---------------- Ahora afecto a todos los estudios con esta determinacion ----------------//

        $sql1 = "select * from determinaciones where coddetermina='$coddetermina' order by codestudio ";
	    $res1=pg_query($conn,$sql1);
        while ($row2 = pg_fetch_array($res1))
	         {
	          $codestudio=$row2[codestudio];
              
	 	     $result2 = pg_query($conn, "UPDATE determinacionrango set sexo=$sexo, 
                                                                       edadmin=$edadmin, 
                                                                       edadmax=$edadmax, 
                                                                       tipoedad=$tipoedad, 
                                                                       inirango=$inirango, 
                                                                       finrango=$finrango, 
                                                                       codresultado1='$codresultado1', 
                                                                       codresultado2='$codresultado2', 
                                                                       codresultado3='$codresultado3',
																	   generico='$generico' 
                                           where codestudio='$codestudio' and coddetermina = '$coddetermina' and tipo = '$tipox'");
	         }      	
        
		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_433";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Rangos de Determinaciones: Modifica-Reg.: ".$coddetermina.', Cod.Posicion: '.$tipo;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: modifica_determinaciones.php?mensage=7&id=".$coddetermina."#grilla");
       }
	else
       {
   		header("Location: modifica_rangosrel.php?mensage2=1&coddetermina=$coddetermina&tipo=$tipox"); 
       }
?>
