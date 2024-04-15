<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   
   $codusu=$_SESSION['codusu']; // usuario de la sesion      
   include("conexion.php");
   $con=Conectarse();
			
	$nordentra   = $_POST['nrordentra'];
	$codservicio = $_POST['codservicio1'];
    $indica      = $_POST['indica'];
    $nroturno    = $_POST['nroturno'];
	 
    $archivo     = $_POST['archivo'];
	
	$nomarchivo=trim("Orden_".$codservicio."_".$nordentra).".pdf";
	
	$direc = "documentos/".$nomarchivo;
	
	if (file_exists ("documentos/".$nomarchivo))
	{
		unlink("documentos/$nomarchivo");
	}
	
	// Ahora voy a incluir en una carpeta el archivo
	
	$directorio = "documentos";
	/* Comprobamos si el directorio temporal esta creado, si no lo esta lo creamos*/
	if (file_exists ($directorio) )
	{
		$documento 		= $_FILES['archivo']['name'];
		$tipo 				= $_FILES['archivo']['type'];
		$tamano_archivo 	= $_FILES['archivo']['size'];
		
		
		if (copy($_FILES['archivo']['tmp_name'], $directorio.'/'.$documento))
		{
			$documentonew = $nomarchivo; 
			
			rename ($directorio.'/'.$documento, $directorio.'/'.$documentonew);
			
		}
        
        if($indica == 1)
        {
            header("Location: navegador_ordenes.php?nordentra=$nordentra&codservicio=$codservicio&nroturno=$nroturno&indica=$indica");
        }
        else
        {
            header("Location: modifica_ordenes.php?nordentra=$nordentra&codservicio=$codservicio");
        }
		

	}	 	
	pg_close($con); 
?>