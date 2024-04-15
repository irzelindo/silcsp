<?php
	include("conexion.php");
    $link=Conectarse();
    include("bitacora.php");
    $codusu = $_GET['codusu'];
    $codopc = "Sale";
    $fecha=date("Y-n-j", time());
    $hora=date("G:i:s",time());
    $accion="Abandona el sistema";
    $terminal = $_SERVER['REMOTE_ADDR'];
    $a=archdlog($codusu,$codopc,$fecha,$hora,$accion,$terminal);
    // Fin grabacion de registro de auditoria

	header("Location: index.php");
?>