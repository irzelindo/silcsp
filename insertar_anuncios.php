<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $_SESSION['archivo'] = $_POST['archivo'];
   $_SESSION['texto']   = $_POST['texto'];
   $_SESSION['fecha']   = $_POST['fecha'];  
   $_SESSION['parafl']  = $_POST['parafl'];
   $_SESSION['paracli'] = $_POST['paracli'];

   $codusu=$_SESSION['codusu'];      

   include("conexion.php"); 
   $conn=Conectarse();
			
   $archivo = trim($_POST['archivo']);
   $texto = trim($_POST['texto']);
   
    $nroreg1=0;
    $nroreg2=0; 

    $norden=0;
    $ultimoorden = pg_query($conn,"select norden from anuncios order by norden"); 
    while ($row = pg_fetch_array($ultimoorden))
	    {
	    $norden = $row['norden'];
	    }
    $norden=$norden+1;

   $fecha      = date("Y-n-j", time());
   $parafl     = 1*$_POST['parafl'];
   $paracli    = 1*$_POST['paracli'];
   if($parafl==0){$parafl=2;}
   if($paracli==0){$paracli=2;}
   $archivo     = $_POST['archivo'];    

  $directorio1 = "fotos";
  $nomarchivo1 = "anuncio".$norden.".jpg";

  $ok2="SI";
  if (file_exists ($directorio1) )
	{
	$documento1 		= $_FILES['archivo']['name'];
	$tipo1 				= $_FILES['archivo']['type'];
	$tamano_archivo1 	= $_FILES['archivo']['size'];

    if($tamano_archivo1>0)
       {
	    if($tamano_archivo1>500000 || ($tipo1!= 'image/jpeg' && $tipo1!= ''))
	      {
	      header("Location: nuevo_anuncios.php?mensage=2");
	      $ok2="NO";
		  }	  
       }
    else
	   {
	   	$nomarchivo1='';
	   }   
	}

   $ok1='SI'; // valida fecha

    
    
if 	($ok1=='SI' && $ok2=='SI') 
	{
    $fecha=date("Y-n-j", time());

    $nroreg2=0;
    	
    if ($nroreg2==0)
	   {
	 	$result = pg_query($conn,"INSERT INTO anuncios (norden,fecha, texto, archivo, veempresa,vecliente) values ($norden, '$fecha', '$texto','$nomarchivo1',$parafl,$paracli)"); 

        if($tamano_archivo1>0)
           {
            $documentox1='temporal.jpg';
    	   	if (copy($_FILES['archivo']['tmp_name'], $directorio1.'/'.$documentox1))
    			{
    			$documentonew1 = $nomarchivo1; // Nombre del documento 
    			rename ($directorio1.'/'.$documentox1, $directorio1.'/'.$documentonew1); // Cambia nombre de tapagrande
    			//unlink("fotos/$documento");
    	     	}
           }	

		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_54";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Anuncios: Inserta-Reg.: ".$norden."-".$texto;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: anuncios.php?mensage=9");
   		
       }
	else
       {
   		header("Location: nuevo_anuncios.php?mensage=1"); 
       }

    }
else
    {
    if($ok1=='NO')
	  {
      header("Location: nuevo_anuncios.php?mensage=1");		
	  }
	else
	  {
      header("Location: nuevo_anuncios.php?mensage=2");		
	  }  	
    
	}
?>
