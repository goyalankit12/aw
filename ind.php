<?php
$user = $_COOKIE["cards"];
$type = $_POST["type"];
$desc = $_POST["desc"];
error_reporting(E_ALL);
ini_set("display_errors", 1);
$appName = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$connStr = "host=ec2-23-21-197-175.compute-1.amazonaws.com port=5432 dbname=d2bu35u7977nam user=zhnknooxixzmqn password=6772ed3336642783bb0c73e57993b98f4f4994386fed3ae08666a0ed9c91ec2a";

$conn = pg_connect($connStr);



$sql="INSERT INTO \"activity\" (\"user\",\"type\",\"desc\") VALUES ($user,$type,$desc)";
$result = pg_query($conn,$sql);
//simple check
$result = pg_query($conn, "select * from \"user\"");
//var_dump(pg_fetch_all($result));    //   $row = $results->fetchArray();
//  var_dump($results);
$success=0;
$id=0;
$name="";
/* while ($row = $results->fetchArray()) {
     $success=1;
     $id=$row['id'];
     $name=$row['name'];
 }
 if($success==1){

   //  $sql="INSERT INTO 'main'.'login' ('name') VALUES ('$user')";
     //$results=$databaseConnectionObj->db->query($sql);
     //echo "<script>window.open('profile.php?id=$id&name=$name','_self','')</script>";

 }
 else echo "failed";
*/


?>
