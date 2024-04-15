<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();

   $_SESSION['codservicio']   = $_POST['codservicio'];
   $_SESSION['director']   = $_POST['director'];  
   $_SESSION['cargodir']   = $_POST['cargodir'];
   $_SESSION['nomyapefir']  = $_POST['nomyapefir'];
   $_SESSION['cuentagral'] = $_POST['cuentagral'];
   $_SESSION['nomctagral'] = $_POST['nomctagral'];
   $_SESSION['nomyapedep'] = $_POST['nomyapedep'];
   $_SESSION['concepto'] = $_POST['concepto']; 

   $_SESSION['n_recibo_ini'] = $_POST['n_recibo_ini'];
   $_SESSION['n_recibo'] = $_POST['n_recibo'];
   $_SESSION['n_recibo_fin'] = $_POST['n_recibo_fin'];
   $_SESSION['serie'] = $_POST['serie'];
   $_SESSION['np_mensaje'] = $_POST['np_mensaje'];
   $_SESSION['decreto'] = $_POST['decreto'];
   $_SESSION['ruc'] = $_POST['ruc'];

   $_SESSION['archivo1'] = $_POST['archivo1'];
   $_SESSION['archivo2'] = $_POST['archivo2'];

   $codusu=$_SESSION['codusu'];      

   include("conexion.php"); 
   $conn=Conectarse();
			
   $archivo1 = trim($_POST['archivo1']);
   $archivo2 = trim($_POST['archivo2']);
    
   $codservicio    = trim($_POST['codservicio']);
   $director       = trim($_POST['director']);
   $cargodir       = trim($_POST['cargodir']);
   $nomyapefir     = trim($_POST['nomyapefir']);
   $cuentagral     = trim($_POST['cuentagral']);
   $nomctagral     = trim($_POST['nomctagral']);
   $nomyapedep     = trim($_POST['nomyapedep']);
   $concepto       = trim($_POST['concepto']);

   $n_recibo_ini   = intval($_POST['n_recibo_ini']);
   $n_recibo       = intval($_POST['n_recibo']);
   $n_recibo_fin   = intval($_POST['n_recibo_fin']);
   $serie          = trim($_POST['serie']);
   $np_mensaje     = intval($_POST['np_mensaje']);
   $decreto        = trim($_POST['decreto']);
   $ruc            = trim($_POST['ruc']);

   $archivo1     = $_POST['archivo1'];    
   $archivo2     = $_POST['archivo2'];    

  $ok2="SI";
  $directorio1 = "firmas";
  $nomarchivo11 = $codservicio."firma1.jpg";

  if (file_exists ($directorio1) )
	{
	$documento1 		= $_FILES['archivo1']['name'];
	$tipo1 				= $_FILES['archivo1']['type'];
	$tamano_archivo11 	= $_FILES['archivo1']['size'];

    if($tamano_archivo11>0)
       {
	    if($tamano_archivo11>500000 || ($tipo1!= 'image/jpeg' && $tipo1!= ''))
	      {
//	      header("Location: nuevo_configuracion_gral.php?mensage=2");
	      $ok2="NO";
		  }	  
       }
    else
	   {
	   	$nomarchivo11='';
	   }   
	}

  $directorio2 = "firmas";
  $nomarchivo12 = $codservicio."firma2.jpg";


  if (file_exists ($directorio2) )
	{
	$documento2 		= $_FILES['archivo2']['name'];
	$tipo2 				= $_FILES['archivo2']['type'];
	$tamano_archivo12 	= $_FILES['archivo2']['size'];

    if($tamano_archivo12>0)
       {
	    if($tamano_archivo12>500000 || ($tipo2!= 'image/jpeg' && $tipo2!= ''))
	      {
//	      header("Location: nuevo_configuracion_gral.php?mensage=2");
	      $ok2="NO";
		  }	  
       }
    else
	   {
	   	$nomarchivo12='';
	   }   
	}
     
   //-----------------------------------------------------------------//
   $ok1='SI'; // valida establecimiento
	$query1 = "select * from config_gral where codservicio = '$codservicio'";
    $result1 = pg_query($conn, $query1);
    $nroreg1=pg_num_rows($result1);
    
    if($nroreg1>0)
       {
//        header("Location: nuevo_configuracion_gral.php?mensage=1");
	    $ok1="NO";
       }
         
if 	($ok1=='SI' && $ok2=='SI') 
	{

	 	$result = pg_query($conn,"INSERT INTO config_gral (codservicio,director, cargodir, nomyapefir, cuentagral,nomctagral, nomyapedep, concepto, n_recibo_ini, n_recibo, n_recibo_fin, serie, np_mensaje, decreto, ruc) values ('$codservicio', '$director', '$cargodir', '$nomyapefir','$cuentagral','$nomctagral', '$nomyapedep', '$concepto', $n_recibo_ini, $n_recibo, $n_recibo_fin, '$serie', $np_mensaje, '$decreto', '$ruc')"); 

        if($tamano_archivo11>0)
           {
            $documentox1='temporal1.jpg';
    	   	if (copy($_FILES['archivo1']['tmp_name'], $directorio1.'/'.$documentox1))
    			{
    			$documentonew1 = $nomarchivo11; // Nombre del documento 
    			rename ($directorio1.'/'.$documentox1, $directorio1.'/'.$documentonew1); // Cambia nombre de tapagrande
    			//unlink("firmas/$documento1");
    	     	}
           }	

        if($tamano_archivo12>0)
           {
            $documentox2='temporal2.jpg';
    	   	if (copy($_FILES['archivo2']['tmp_name'], $directorio2.'/'.$documentox2))
    			{
    			$documentonew2 = $nomarchivo12; // Nombre del documento 
    			rename ($directorio2.'/'.$documentox2, $directorio2.'/'.$documentonew2); // Cambia nombre de tapagrande
    			//unlink("firmas/$documento2");
    	     	}
           }


		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_4115";
	    $director1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Config. Gral: Inserta-Reg.: ".$codservicio."-".$director;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$director1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: configuracion_gral.php?mensage=9");

    }
else
    {
    if($ok1=='NO')
	  {
      header("Location: nuevo_configuracion_gral.php?mensage2=1");		
	  }
	else
	  {
      header("Location: nuevo_configuracion_gral.php?mensage2=2");		
	  }  	
    
	}
    
?>
