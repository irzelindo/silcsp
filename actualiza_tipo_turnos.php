<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $_SESSION['regionx']=$_POST['regionx'];
   $_SESSION['codserviciox']=$_POST['codserviciox'];
   $_SESSION['codareax']=$_POST['codareax'];
   $_SESSION['codturno']=$_POST['codturno'];
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
			
	   
    $region = $_POST['regionx'];
    $codservicio = $_POST['codserviciox'];
    $codarea = $_POST['codareax'];
	$codturno  = $_POST['codturno'];
	$nomturno  = trim($_POST['nomturno']);
	$nomturnox = trim($_POST['nomturnox']);

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

       
/*	
echo $codturno;
echo'<br>';
echo $nomturno;
echo'<br>';
echo $nomturnox;
*/   
	$query2 = "select * from tiposturnos where nomturno = '$nomturno'  and codservicio='$codservicio' and codarea='$codarea'";
    $result2 = pg_query($conn,$query2);
    $nroreg2=pg_num_rows($result2);

    if ($nroreg2==0 || ($nroreg2>0 && $nomturno==$nomturnox))
	   {
        $result = pg_query($conn,"UPDATE tiposturnos SET nomturno='$nomturno', 
                                                         cantlun=$cantlun, 
                                                         cantmar=$cantmar, 
                                                         cantmie=$cantmie, 
                                                         cantjue=$cantjue, 
                                                         cantvie=$cantvie, 
                                                         cantsab=$cantsab, 
                                                         cantdom=$cantdom, 
                                                         horarlun='$horarlun', 
                                                         horarmar='$horarmar', 
                                                         horarmie='$horarmie', 
                                                         horarjue='$horarjue', 
                                                         horarvie='$horarvie', 
                                                         horarsab='$horarsab', 
                                                         horardom='$horardom' 
                                                   WHERE codturno='$codturno' and codservicio='$codservicio' and codarea='$codarea'"); 
     	
		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_4112";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Tipos de Turnos: Modifica-Reg.: ".$codturno."-".$nomturno.", Servicio: ".$codservicio.", Area: ".$codarea;
        $terminal = $_SERVER['REMOTE_ADDR']; 
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: tipo_turnos.php?mensage=7");
       }
	else
       {
   		header("Location: modifica_tipo_turnos.php?id=$codturno&codservicio=$codservicio&codarea=$codarea&mensage2=2"); 
       }  

?>
