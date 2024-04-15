<?php
include("conexion.php");
$link=Conectarse();
session_start();
session_unset();

$usuario = trim($_POST["usuario"]);
$clave = trim($_POST["contrasena"]);
$clave1 = md5($clave);
$estado=1;


	$query = "SELECT * FROM usuarios where (codusu = '$usuario') and (clave = '$clave' or clave = '$clave1')";
    $result=pg_query($link, $query);

    $ok = pg_fetch_array($result);

	if (($ok["codusu"] == $usuario) && ($ok["clave"] == $clave || $ok["clave"] == $clave1) && $ok["estado"] == $estado)
	   {
			$_SESSION["usuario"] = "SI";

			$_SESSION["codusu"] = $ok["codusu"];
			$_SESSION["clave"] = $ok["clave"];
			$_SESSION["nomyape"] = utf8_decode($ok["nomyape"]);
			$_SESSION["laboratorio"] = $ok["laboratorio"];
			$_SESSION["codservicio"] = $ok["codservicio"];
$_SESSION["email"] = $ok["email"];
		
/*    		$_SESSION["regx"] = $ok["codreg"];
    		$_SESSION["subx"] = $ok["subcreg"];
    		$_SESSION['disx'] = $ok["coddist"];
    		$_SESSION['estx'] = $ok["codest"];*/

	        // busco los permisos
	        $query3 = "SELECT * FROM perfiles where codusu = '$usuario'";
	        $result3=pg_query($link, $query3);

	        while ($row = pg_fetch_array($result3))
		          {
	 		      $_SESSION[$row['codopc']]=$row['modo'];
	  	          }


			//  Graba registro de Auditoria
	        include("bitacora.php");
		    $codopc = "entra";
		    $fecha=date("Y-n-j", time());
	        $hora=date("G:i:s",time());
	        $accion="Ingresa al sistema";
	        $terminal = $_SERVER['REMOTE_ADDR'];
	        $a=archdlog($usuario,$codopc,$fecha,$hora,$accion,$terminal);
	        // Fin grabacion de registro de auditoria
			header("Location: menu.php");
		}


	if ($ok["codusu"]=="" || $ok["clave"]=="" || $ok["estado"]!= 1)
		{
		//si esta en blanco o si esta inactivo va a login.php
		header("Location: index.php?blanco=si");
		}

if($_GET["cerrar"]==true)
	{
	session_start();
	session_unset();
	session_destroy();
	Header ("Location: index.php");
	}
?>
