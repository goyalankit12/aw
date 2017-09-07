<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
setcookie("cards", " ");


$appName = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
//$connStr = "host=localhost port=5432 dbname=aw user=postgres password=Ankit@14";
$connStr = "host=ec2-23-21-197-175.compute-1.amazonaws.com port=5432 dbname=d2bu35u7977nam user=zhnknooxixzmqn password=6772ed3336642783bb0c73e57993b98f4f4994386fed3ae08666a0ed9c91ec2a";

$conn = pg_connect($connStr);


if(isset($_POST["pass"])){
    $pass = $_POST["pass"];
    $user = $_POST["userName"];
     $sql="select * from \"login\" WHERE \"user\" = '$user' and \"password\" = '$pass'";
    $result = pg_query($conn,$sql);
       $success=0;
        while ($row =  pg_fetch_row($result)) {
            $success=1;
        }
        if($success==1){
            setcookie("cards", $user);
            $sql="INSERT INTO \"loginTrack\" (\"user\") VALUES ('$user')";
            $result = pg_query($conn,$sql);
            echo "<script>window.open('profile.php?name=$user','_self','')</script>";
        }
        else echo  "<script>alert('Wrong User id or Password')</script>";

}
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
      <h4 style="color: darkgreen;" > <?php if (isset($_GET["msg"])) echo $_GET["msg"]; ?> </h4>

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
