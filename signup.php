<?php
if(isset($_POST["pass"])){
 //   $_POST["pass"];
    $pass = $_POST["pass"];
    $user = $_POST["userName"];


    $appName = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $connStr = "host=ec2-23-21-197-175.compute-1.amazonaws.com port=5432 dbname=d2bu35u7977nam user=zhnknooxixzmqn password=6772ed3336642783bb0c73e57993b98f4f4994386fed3ae08666a0ed9c91ec2a";

    $conn = pg_connect($connStr);


    $sql="INSERT INTO \"login\" (\"user\",\"password\") VALUES ('$user','$pass')";
    $results = pg_query($conn,$sql);

    if(!$results){
        echo "Creation Failed";
    }
    else{
        echo "<script>window.open('index.php','_self','')</script>";
    }
  //  if($success==1) echo "sucess";
   // else echo "failed";


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
                    <input class="button" type="submit" name="butSubmit" value="Signup" /><br/><br/>


                </p>
            </div>
        </form>
    </div>
</div>
</body>
</html>
