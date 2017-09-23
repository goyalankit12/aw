<?php
$user = $_COOKIE["cards"];
$type = $_POST["type"];
$desc = $_POST["desc"];
$head = $_POST["head"];
error_reporting(E_ALL);
ini_set("display_errors", 1);
$appName = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$connStr = "host=ec2-23-21-197-175.compute-1.amazonaws.com port=5432 dbname=d2bu35u7977nam user=zhnknooxixzmqn password=6772ed3336642783bb0c73e57993b98f4f4994386fed3ae08666a0ed9c91ec2a";
$conn = pg_connect($connStr);
echo $sql="INSERT INTO \"activity\" (\"user\",\"type\",\"desc\",\"head\") VALUES ('$user','$type','$desc','$head')";
$result = pg_query($conn,$sql);

?>
