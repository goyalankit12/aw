<?php

$user = $_GET['name'];
$appName = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$connStr = "host=ec2-23-21-197-175.compute-1.amazonaws.com port=5432 dbname=d2bu35u7977nam user=zhnknooxixzmqn password=6772ed3336642783bb0c73e57993b98f4f4994386fed3ae08666a0ed9c91ec2a";
//$connStr = "host=localhost port=5432 dbname=aw user=postgres password=Ankit@14";
$conn = pg_connect($connStr);
$sql="SELECT * from \"loginTrack\" where \"user\" = '$user'";
$result = pg_query($conn,$sql);

$sql="SELECT * from \"activity\" where \"user\" = '$user'";
$resultActivity = pg_query($conn,$sql);


?>

<html>
<head>
    <link href="CSS/login.css" rel="stylesheet" type="text/css">
    <SCRIPT LANGUAGE="JavaScript">



    </SCRIPT>
</head>
<body >
<h1 align="center" style="color: #f24537"><?php echo $user; ?></h1>
<div align="center"><a style="font-size: 16px;" href="index.php">logout</a></div>
<br/><br/>
<div align="center"><a style="font-size: 18px;" href="https://stackoverflow.com/questions/tagged/java?sort=frequent&pageSize=15">Goto: Stackoverflow </a></div>


<div align="center" class="Loginform" >
    <h1> User Actions </h1>
   <p style="text-align: justify" > There are two types of user behaviours 1. Implicit behaviours   2. Explicit behaviours.
    Implicit Behaviours are those activities which are known to user like posting the question, like, comments etc.
    Explicit behaviours are those activities which are not known to users like the time spent on the page, scrolling etc.
    It is equally important to record both types of activties. Implicit behaviour and ecplicit behaviours give us the correct idea about the user
    preferences.
    <br/>.
    we are recording following acitivities corresponding to each user.
    <br/>
    <ol align="left" >
        <li> <b>Posting Question:</b> This helpls us tracking the count and type of question being posted by user. This helps us getting his interest area.</li>
        <li> <b>Answering Question:</b> This helpls us tracking user's expertise area.
        <li> <b>Like and Dislike:</b> This helpls us tracking the likes and dis likes of the user.
        <li> <b>Comments:</b> This helpls us tracking the type and quality of the comments made by user. This can also give us idea about the areas in which user has knowledge.</li>
        <li> <b>Click:</b> This helpls us tracking the click made by user and context attached to that click.</li>
        <li> <b>Scrolling Page:</b> This helpls us tracking the amount of information read by user on particular topic. How many/ detailed answers he read or he just get satisfy with top answers.</li>
        <li> <b>Bookmark:</b> This helpls us tracking the pages frequently visited by a user.</li>

    </ol>
    </p>
    <div class="inset">
    </div>
</div>

    <div align="center" class="Loginform" >
        <h1> User Login Details </h1>
        <div class="inset">

        <table border="1" align="center">
            <thead style="font-size: 12px;font-weight: bold" >
            <tr>
                <td>
                    Sno.
                </td>
                <td>
                    Login Date and Time
                </td>
            </tr>
            </thead>
            <tbody>

                <?php
                    $i=1;
                    while ($row =  pg_fetch_row($result)) {
                        ?>
                        <tr> <td> <?php echo $i++;?></td><td><?php echo $row[1]; ?></td> </tr>
                    <?php }  ?>
            </tbody>

        </table>
    </div>
    </div>


        <div align="center" class="Loginform" >
            <h1> Activites Details </h1>
            <div class="inset">

                <table border="1" align="center">
                    <thead style="font-size: 12px;font-weight: bold" >
                    <tr>
                        <td>
                            Sno.
                        </td>
                        <td>
                            Type
                        </td>
                        <td>
                            Description
                        </td>
                        <td>
                            Time
                        </td>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    $i=1;
                    while ($row =  pg_fetch_row($resultActivity)) {
                        ?>
                        <tr> <td> <?php echo $i++;?></td><td><?php echo $row[1]; ?></td><td><?php echo $row[2]; ?></td><td><?php echo $row[3]; ?></td> </tr>
                    <?php }  ?>
                    </tbody>

                </table>
            </div>



        </div>
</body>
</html>
