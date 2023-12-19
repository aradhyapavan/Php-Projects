<?php 
// DB credentials.

define('DB_HOST','sql313.ultimatefreehost.in');
define('DB_USER','ltm_24598003');
define('DB_PASS','aradhya123');
define('DB_NAME','ltm_24598003_mk');
// Establish database connection.
try
{
$dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
}
catch (PDOException $e)
{
exit("Error: " . $e->getMessage());
}


$con = mysqli_connect("sql313.ultimatefreehost.in","ltm_24598003","aradhya123","ltm_24598003_mk");
?>