<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $_SESSION['region']=$_POST['region'];
   $_SESSION['codservicio']=$_POST['codservicio'];
   $_SESSION['codarea']=$_POST['codarea'];
   $_SESSION['nomturno']=$_POST['nomturno'];

   $_SESSION['cantlun']      = $_POST['cantlun'];
   $_SESSION['cantmar']      = $_POST['cantmar'];
   $_SESSION['cantmie']      = $_POST['cantmie'];
   $_SESSION['cantjue']      = $_POST['cantjue'];
   $_SESSION['cantvie']      = $_POST['cantvie'];
   $_SESSION['cantsab']      = $_POST['cantsab'];
   $_SESSION['cantdom']      = $_POST['cantdom'];
   $_SESSION['horarlun']      = $_POST['horarlun'];
   $_SESSION['horarmar']      = $_POST['horarmar'];
   $_SESSION['horarmie']      = $_POST['horarmie'];
   $_SESSION['horarjue']      = $_POST['horarjue'];
   $_SESSION['horarvie']      = $_POST['horarvie'];
   $_SESSION['horarsab']      = $_POST['horarsab'];
   $_SESSION['horardom']      = $_POST['horardom'];

   $codusu=$_SESSION['codusu'];      

   include("conexion.php");
   $conn=Conectarse();

   $region = $_POST['region'];
   $codservicio = $_POST['codservicio'];
   $codarea = $_POST['codarea'];
   $nomturno = trim($_POST['nomturno']);

   $cantlun      = 1*$_POST['cantlun'];
   $cantmar      = 1*$_POST['cantmar'];
   $cantmie      = 1*$_POST['cantmie'];
   $cantjue      = 1*$_POST['cantjue'];
   $cantvie      = 1*$_POST['cantvie'];
   $cantsab      = 1*$_POST['cantsab'];
   $cantdom      = 1*$_POST['cantdom'];
   $horarlun     = $_POST['horarlun'];
   $horarmar     = $_POST['horarmar'];
   $horarmie     = $_POST['horarmie'];
   $horarjue     = $_POST['horarjue'];
   $horarvie     = $_POST['horarvie'];
   $horarsab     = $_POST['horarsab'];
   $horardom     = $_POST['horardom'];

   $codturno=0;
   $ultimoorden = pg_query("select codturno from tiposturnos where codservicio='$codservicio' and codarea='$codarea' order by codturno"); 
   while ($row = pg_fetch_assoc($ultimoorden))
	   {
	   $codturno = $row['codturno'];
	   }
	$codturno=$codturno+1;

/*echo '<br> codturno: '.$codturno;
echo '<br> nomturno: '.$nomturno;
echo '<br> codservicio: '.$codservicio;
echo '<br> region:'.$region;
*/
	
	$query1 = "select * from tiposturnos where codturno = '$codturno'  and codservicio='$codservicio' and codarea='$codarea'";
    $result1 = pg_query($conn, $query1);
    $nroreg1=pg_num_rows($result1);

	$query2 = "select * from tiposturnos where nomturno = '$nomturno'  and codservicio='$codservicio' and codarea='$codarea'";
    $result2 = pg_query($conn, $query2);
    $nroreg2=pg_num_rows($result2);

    if ($nroreg1==0 && $nroreg2==0)
	   {
	 	$result = pg_query($conn, "insert into tiposturnos( codservicio, codarea, codturno, nomturno, cantlun, cantmar, cantmie, cantjue, cantvie, cantsab, cantdom, horarlun, horarmar, horarmie, horarjue, horarvie, horarsab, horardom) values ('$codservicio', '$codarea', $codturno, '$nomturno', $cantlun, $cantmar, $cantmie, $cantjue, $cantvie, $cantsab, $cantdom, '$horarlun', '$horarmar', '$horarmie', '$horarjue', '$horarvie', '$horarsab', '$horardom')"); 

		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_4112";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Tipos de Turnos: Inserta-Reg.: ".$codturno."-".$nomturno.", Servicio: ".$codservicio.", Area: ".$codarea;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: tipo_turnos.php?mensage=9");
       }
	else
       {
        if ($nroreg1!=0)
           {
       		header("Location: nuevo_tipo_turnos.php?mensage2=1"); 
           }
        if ($nroreg2!=0)
           {
       		header("Location: nuevo_tipo_turnos.php?mensage2=2"); 
           }
       }
?>
