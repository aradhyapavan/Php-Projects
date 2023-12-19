<?php 
// DB credentials.

define('DB_HOST','sql306.ihostfull.com');
define('DB_USER','uoolo_22391423');
define('DB_PASS','aradhya123');
define('DB_NAME','uoolo_22391423_blog');
// Establish database connection.
try
{
$dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
}
catch (PDOException $e)
{
exit("Error: " . $e->getMessage());
}


$con = mysqli_connect("sql306.ihostfull.com","uoolo_22391423","aradhya123","uoolo_22391423_blog");
?>