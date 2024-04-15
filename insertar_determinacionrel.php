<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $_SESSION['codestudio']=$_POST['codestudio'];
   $_SESSION['coddetermina']=$_POST['coddetermina'];
   $codusu=$_SESSION['codusu'];      

   include("conexion.php");
   $conn=Conectarse();
			
   $codestudio = trim($_POST['codestudio']);
   $coddetermina = trim($_POST['coddetermina']);
	
   
	$query1 = "select * from determinaciones where codestudio = '$codestudio' and coddetermina = '$coddetermina'";
    $result1 = pg_query($conn, $query1);
    $nroreg1=pg_num_rows($result1); 

    $posicion=0;
    $ultimoorden = pg_query($conn,"select posicion from determinaciones where codestudio = '$codestudio' order by posicion"); 
    while ($row = pg_fetch_array($ultimoorden))
	    {
	    $posicion = $row['posicion'];
	    }
    $posicion=$posicion+1;

    if ($nroreg1==0)
	   {
	       
        $cadena1="select * from determinaciones where coddetermina='$coddetermina'";
        $lista1 = pg_query($conn, $cadena1);
        $registro1 = pg_fetch_array($lista1);
        $nomdetermina=$registro1['nomdetermina'];   
        
        //  ----- Copio datos del MASTER -----//
        $codumedida=$registro1['codumedida'];   
        $codresultado=$registro1['codresultado'];   
        $tipo=$registro1['tipo'];   
        $abreviatura=$registro1['abreviatura'];   
        $tiempohab=$registro1['tiempohab'];   
        $tiempourg=$registro1['tiempourg'];   
                      
	 	$result = pg_query($conn, "insert into determinaciones( codestudio, coddetermina, nomdetermina, posicion, codumedida, codresultado, tipo, abreviatura, tiempohab, tiempourg) values ('$codestudio', '$coddetermina', '$nomdetermina', $posicion, '$codumedida', '$codresultado', '$tipo', '$abreviatura', $tiempohab, $tiempourg)"); 
   
        //  ----- Ahora Copio datos del MASTER de RANGOS y RESULTADOS POSIBLES -----//
        $sql1 = "select * from determinacionrango where coddetermina='$coddetermina' order by tipo ";
	    $res1=pg_query($conn,$sql1);
        while ($row2 = pg_fetch_array($res1))
	         {
	         $tipo=$row2[tipo]; 
	         $sexo=$row2[sexo]; 
	         $edadmin=$row2[edadmin]; 
	         $edadmax=$row2[edadmax]; 
             $tipoedad=$row2[tipoedad];
	         $inirango=$row2[inirango]; 
	         $finrango=$row2[finrango]; 
	         $codresultado1=$row2[codresultado1]; 
	         $codresultado2=$row2[codresultado2]; 
	         $codresultado3=$row2[codresultado3]; 
             
             $result1 = pg_query($conn, "insert into determinacionrango( codestudio, coddetermina, tipo, sexo, edadmin, edadmax, tipoedad, inirango, finrango, codresultado1, codresultado2, codresultado3 ) values ('$codestudio', '$coddetermina', $tipo, $sexo, $edadmin, $edadmax, $tipoedad, $inirango, $finrango, '$codresultado1', '$codresultado2', '$codresultado3' )");
	         }
        //---------------------------------------------------------------------------//
        $sql2 = "select * from resultadoposiblemaster where coddetermina='$coddetermina' order by codresultado ";
	    $res2=pg_query($conn,$sql2);
        while ($row3 = pg_fetch_array($res2))
	         {
	         $codresultado=$row3[codresultado]; 
             
             $result2 = pg_query($conn, "insert into resultadoposible( codestudio, coddetermina, codresultado) values ('$codestudio', '$coddetermina', '$codresultado')");
	         }
        //---------------------------------------------------------------------------//
		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_431";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Determinaciones de Estudios: Inserta-Reg.: ".$codestudio."-".$nomestudio.', Cod.Determinacion: '.$coddetermina;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: modifica_estudios.php?mensage=9&id=".$codestudio);
       }
	else
       {
   		header("Location: nuevo_determinacionrel.php?mensage2=1&codestudio=$codestudio"); 
       }
?>
