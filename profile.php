<?php
$id = $_GET['id'];
$user = $_GET['name'];
include ("DatabaseConnection_cls.php");
$databaseConnectionObj= new databaseConnection();
$sql="select * from 'main'.'login' where name = '$user'";// and password='$user'";
$results=$databaseConnectionObj->db->query($sql);
  $row = $results->fetchArray();
    var_dump($row);
  ?>

<html>
<head>
    <link href="CSS/login.css" rel="stylesheet" type="text/css">
    <SCRIPT LANGUAGE="JavaScript">



    </SCRIPT>
</head>
<body >
<div>

    <div align="right"><a href="index.php">logout</a>
</div>
</body>
</html>
