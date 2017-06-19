<?php 

/*define("dbName","mundoatl_soltaxi");
define("dbUser","mundoatl_soltaxi"); 
define("dbHost","localhost"); 
define("dbPassw","sol1234taxi");
$DB = mysql_connect(dbHost, dbUser, dbPassw) or die(mysql_error());
mysql_select_db(dbName);*/




define("dbName","rutasysa_ad_control");
define("dbUser","rutasysa_ad_cont"); 
define("dbHost","localhost"); 
define("dbPassw","ad3245control");
$DB = mysql_connect(dbHost, dbUser, dbPassw) or die(mysql_error());
mysql_select_db(dbName,$DB); ?>
