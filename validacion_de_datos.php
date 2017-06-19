



<?php

/* Define los valores que seran evaluados, en este ejemplo son valores estaticos,
en una verdadera aplicacion generalmente son dinamicos a partir de una base de datos */




/* Extrae los valores enviados desde la aplicacion movil */
$usuarioEnviado = $_GET['usuario'];
$passwordEnviado = $_GET['password'];

define("dbName","rutasysa_ad_control");
define("dbUser","rutasysa_ad_cont"); 
define("dbHost","localhost"); 
define("dbPassw","ad3245control");
$DB = mysql_connect(dbHost, dbUser, dbPassw) or die(mysql_error());
mysql_select_db(dbName);

$rese = mysql_query("SELECT * FROM usuarios WHERE login='$usuarioEnviado'  ORDER BY login  ;", $DB); 
$rowe = mysql_num_rows($rese);   










/* crea un array con datos arbitrarios que seran enviados de vuelta a la aplicacion */
$resultados = array();
$resultados["hora"] = date("F j, Y, g:i a"); 
$resultados["generador"] = "Enviado desde APP" ;
if($rowe>0){
$rege = mysql_fetch_array($rese);
/* verifica que el usuario y password concuerden correctamente */
if(  $rege[0] == $usuarioEnviado && $rege[1] == $passwordEnviado){
	/*esta informacion se envia solo si la validacion es correcta */
	$resultados["mensaje"] = "Validacion Correcta";
	$resultados["validacion"] = "ok";
	$resultados["ced"] = $rege[0];
	$_SESSION['ced']=$rege[0];

}}else{
	/*esta informacion se envia si la validacion falla */
	$resultados["mensaje"] = "Usuario y password incorrectos";
	$resultados["validacion"] = "error";
	
}


/*convierte los resultados a formato json*/
$resultadosJson = json_encode($resultados);

/*muestra el resultado en un formato que no da problemas de seguridad en browsers */
echo $_GET['jsoncallback'] . '(' . $resultadosJson . ');';

?>