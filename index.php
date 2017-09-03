<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
//
//
/*echo "<br/>";
echo "<h1>ji</h1>";
echo "hirr";
echo "hitttt";
echo "hi";*/
include ("DatabaseConnection_cls.php");
$databaseConnectionObj= new databaseConnection();
if(isset($_POST["pass"])){
   // $userObj->setpostvars();
   // $userObj->password=base64_encode($_POST["pass"]);
   // $userObj->secondLogin=0;
   // $userObj->checkUser();
     $_POST["pass"];
    $pass = $_POST["pass"];
    $user = $_POST["userName"];

         $sql="select * from 'main'.'user' where name = '$pass' and password='$user'";
        $results=$databaseConnectionObj->db->query($sql);
     //   $row = $results->fetchArray();
      //  var_dump($results);
       $success=0;
       $id=0;
        while ($row = $results->fetchArray()) {
            $success=1;
            $id=$row['id'];
        }
        if($success==1){
            echo "<script>window.open('profile.php?id=$id','_self','')</script>";

        }         else echo "failed";


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
                    <input class="button" type="submit" name="butSubmit" value="Login" /><br/><br/>
                    <input class="button" type="button" name="create" value="Signup" onclick="window.open('signup.php','_self','');" /><br/><br/>


                </p>
            </div>
        </form>
    </div>
</div>
</body>
</html>
