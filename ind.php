<?php
var_dump($_POST);

error_reporting(E_ALL);
ini_set("display_errors", 1);
//
//
/*echo "<br/>";
echo "<h1>ji</h1>";
echo "hirr";
echo "hitttt";
echo "hi";*/
$appName = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
//$connStr = "host=localhost port=5432 dbname=postgres user=postgres password=Ankit@14";


$connStr = "host=ec2-23-21-197-175.compute-1.amazonaws.com port=5432 dbname=d2bu35u7977nam user=zhnknooxixzmqn password=6772ed3336642783bb0c73e57993b98f4f4994386fed3ae08666a0ed9c91ec2a";


//simple check
$conn = pg_connect($connStr);
$result = pg_query($conn, "select * from user");
var_dump(pg_fetch_all($result));    //   $row = $results->fetchArray();
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
<html>
<head>
    <link href="CSS/login.css" rel="stylesheet" type="text/css">
    <SCRIPT LANGUAGE="JavaScript">



        function validatecheck ()
        {
            var x=document.forms["myform"];
            if (x.userName.value==null || x.userName.value=="")
            {
                alert("Enter username");
                return false;
            }
            else if (x.pass.value==null || x.pass.value=="")
            {
                alert("Enter password");
                return false;
            }
        }

    </SCRIPT>
</head>
<body >
<div>

    <div align="center">
        <form class="Loginform" name="myform" action="" method="post" onsubmit="return validatecheck()">
            <h1> User Authentication </h1>
            <div class="inset">
                <p>
                    <label for="password">USERNAME:</label>
                    <input type="text" name="userName" >
                    <br/>

                </p>
                <p>			<label for="password">PASSWORD:</label>
                    <input type="password" name="pass" >
                </p>
                <p class="p-container">
                    <input class="button" type="submit" name="butSubmit" value="Login" /><br/><br/>
                    <input class="button" type="button" name="create" value="Signup" onclick="window.open('signup.php','_self','');" /><br/><br/>


                </p>
            </div>
        </form>
    </div>
</div>
</body>
</html>
