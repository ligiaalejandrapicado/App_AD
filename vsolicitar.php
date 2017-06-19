<?php

$usuarioEnviado = $_GET['usuario'];
$passwordEnviado = $_GET['password'];

define("dbName","rutasysa_ad_control");
define("dbUser","rutasysa_ad_cont"); 
define("dbHost","localhost"); 
define("dbPassw","ad3245control");
$DB = mysql_connect(dbHost, dbUser, dbPassw) or die(mysql_error());
mysql_select_db(dbName);


/* Extrae los valores enviados desde la aplicacion movil */
$ci_sim = $_GET['ci_sim'];



//$ci_sim=preg_replace("/[^0-9]/i","",$ci);



$band=0;
if(empty($ci_sim) ){ $var="*C.I\n"; $band=1;}


$rese = mysql_query("SELECT * FROM simpatizante WHERE  ci_sim='$ci_sim'  ORDER BY  ci_sim  ;", $DB); 
$rowe = mysql_num_rows($rese);   

/* crea un array con datos arbitrarios que seran enviados de vuelta a la aplicacion */
$resultados = array();
$resultados["hora"] = date("F j, Y, g:i a"); 
$resultados["generador"] = "Enviado desde APP " ;

if($band==1){
	
	$resultados["mensaje"] = "Por favor verificar: \n".$var;
	$resultados["validacion"] = "error";
	
	} else if($band==0){


			if($rowe>0){
	
					/*CONSULTAR LOS DATOS EN LA BASE DE DATOS*/
					while($rege = mysql_fetch_array($rese)){
						
						$resultados["mensaje"] .= "C.I: $rege[0] \n Nombre: $rege[1] \n Dirección: $rege[2] \n Telf. $rege[4] \n\n";
						
					}//END WHILE
			
 			}else if($rowe<=0){
				
						$resultados["mensaje"] = "NO POSEE REGISTRO EN NUESTRO SISTEMA \n";
				
				}//END IF MENOR A CERO
	
	$resultados["validacion"] = "ok";

	}// BAND igual a cero

/*convierte los resultados a formato json*/
$resultadosJson = json_encode($resultados);

/*muestra el resultado en un formato que no da problemas de seguridad en browsers */
echo $_GET['jsoncallback'] . '(' . $resultadosJson . ');';

?>