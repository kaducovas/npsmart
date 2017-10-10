<?php
/** 
 * query table clusters for list of clusters
 * 
 * @author Vitalii Afanasiev - vitalii.afanasiev@huawei.com
 * @version 1.0.0
 */ 
  
// include db config 

define("BASEPATH",""); //solução temporaria
include_once("../config/database.php"); 
$database ="npsmart_aux"; 
$networktype = $_GET["networkType"];

// connect to the database
//$db = mysql_connect(PHPGRID_DBHOST,PHPGRID_DBUSER,PHPGRID_DBPASS) or die("Connection Error: " . mysql_error());
//$db = pg_connect();
$dbconn = pg_connect("host=".$db['default']['hostname']." dbname=$database user=".$db['default']['username']." password=".$db['default']['password'])
    or die('Could not connect: ' . pg_last_error());
//mysql_select_db($database) or die("Error conecting to db.");
 

$data="";


$SQL = "SELECT distinct cluster 
	    FROM clusters as a where a.network_type='$networktype' AND element_type='RNC';";
$result = pg_query( $SQL ) or die("Couldn t execute query.".pg_last_error());

while($row = pg_fetch_array($result,null,PGSQL_ASSOC)) {
	$data = $data.$row['cluster'].',';
} 
 
//return result
echo $data;
?>