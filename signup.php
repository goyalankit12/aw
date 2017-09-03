<?php
include ("DatabaseConnection_cls.php");
$databaseConnectionObj= new databaseConnection();
if(isset($_POST["pass"])){
 //   $_POST["pass"];
    $pass = $_POST["pass"];
    $user = $_POST["userName"];

    $sql="INSERT INTO 'main'.'user' ('name','password') VALUES ('$user','$pass')";
    $results=$databaseConnectionObj->db->query($sql);
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
