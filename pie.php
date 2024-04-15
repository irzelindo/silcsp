<?php

	$query = "SELECT * FROM confgral";
	$result=mysql_query($query);
	$dato = mysql_fetch_assoc($result);
	
	$empresa=$dato["d6"];
	$direccion=$dato["d8"];
	$telefono=$dato["d9"];
	$email=$dato["d11"];


echo $empresa.'<br/>';
echo $direccion.'<br/>';
echo $telefono.'<br/>';
echo $email.'<br/>';

?>