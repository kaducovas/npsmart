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
$dbconn = pg_connect("host=".$db['default']['hostname']." dbname=$database user=".$db['default']['username']." password=".$db['default']['password'])
    or die('Could not connect: ' . pg_last_error());

$data="{";


$SQL = "SELECT distinct id, name 
	    FROM baseline_rules as a where a.network_type='$networktype';";
$result = pg_query( $SQL ) or die("Couldn t execute query.".pg_last_error());

while($row = pg_fetch_array($result,null,PGSQL_ASSOC)) {
	$data = $data."k".$row['id'].":\"".$row['name']."\",";
} 
 
$data = rtrim($data, ",");
$data = $data."}";
 
//return result
echo $data;
?>