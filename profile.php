<?php

$user = $_GET['name'];
$appName = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$connStr = "host=ec2-23-21-197-175.compute-1.amazonaws.com port=5432 dbname=d2bu35u7977nam user=zhnknooxixzmqn password=6772ed3336642783bb0c73e57993b98f4f4994386fed3ae08666a0ed9c91ec2a";
//$connStr = "host=localhost port=5432 dbname=aw user=postgres password=Ankit@14";

function myUrlEncode($string) {
    $entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%25', '%23', '%5B', '%5D');
    $replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]");
    return str_replace($entities, $replacements, urlencode($string));
}

$conn = pg_connect($connStr);

$sql="SELECT count(*) from \"login\"";
$result = pg_fetch_row(pg_query($conn,$sql));
$total_User=$result[0];


$sql="SELECT * from \"loginTrack\" where \"user\" = '$user'";
$result = pg_query($conn,$sql);

$sql="SELECT * from \"activity\" where \"user\" = '$user'";
$resultActivity = pg_query($conn,$sql);
date_default_timezone_set('MST');


$sql="SELECT * from \"activity\" where \"user\" = '$user' and head='Post Question'";
$post_Question = pg_query($conn,$sql);
$sql="SELECT * from \"activity\" where head='Post Question'";
$post_Question_Compare = pg_query($conn,$sql);


$sql="SELECT * from \"activity\" where \"user\" = '$user' and head='Post Answer'";
$post_Answer = pg_query($conn,$sql);
$sql="SELECT * from \"activity\" where head='Post Answer'";
$post_Answer_Compare = pg_query($conn,$sql);




$sql="SELECT * from \"activity\" where \"user\" = '$user' and head='search'";
$search = pg_query($conn,$sql);
$sql="SELECT * from \"activity\" where head='search'";
$search_Compare = pg_query($conn,$sql);


$sql="SELECT * from \"activity\" where \"user\" = '$user' and head='question-hyperlink'";
$question = pg_query($conn,$sql);
$sql="SELECT * from \"activity\" where head='question-hyperlink'";
$question_Compare = pg_query($conn,$sql);

//echo "count".pg_num_rows($question);



$sql="SELECT * from \"activity\" where \"user\" = '$user' and head='post-tag'";
$post_tag = pg_query($conn,$sql);
$sql="SELECT * from \"activity\" where head='post-tag'";
$post_tag_Compare = pg_query($conn,$sql);




$file = fopen('Bardata.csv', 'w');

$row=['salesperson','sales'];
fputcsv($file, $row);

$row=['Posting Question',count($post_Question)];
fputcsv($file, $row);

$row=['post Answer',count($post_Answer)];
fputcsv($file, $row);

$row=['Question',count($question)];
fputcsv($file, $row);

$row=['Post Tag',count($post_tag)];
fputcsv($file, $row);

fclose($file);


/* Post Tag Graph*/
////////////////////////
$wordSensation;
while ($row =  pg_fetch_row($post_tag)) {
    $temparry = explode("/",$row[2]);
    $word = $temparry[sizeof($temparry)-1];
    if(isset($wordSensation[$word])){
        $wordSensation[$word]=$wordSensation[$word]+1;
    }
    else{
        $wordSensation[$word]=1;
    }
}
$Word_KeyArr= array_keys($wordSensation);
$file = fopen('files/bubbleGraph.csv', 'w');
$row =["id","value"];
fputcsv($file, $row);
foreach($Word_KeyArr as $word ) {
    $row = [myUrlEncode($word), $wordSensation[$word]];
    fputcsv($file, $row);
}
fclose($file);

// COmparison Bubblr Graph
unset($wordSensation);
while ($row =  pg_fetch_row($post_tag_Compare)) {
    $temparry = explode("/",$row[2]);
    $word = $temparry[sizeof($temparry)-1];
    if(isset($wordSensation[$word])){
        $wordSensation[$word]=$wordSensation[$word]+1;
    }
    else{
        $wordSensation[$word]=1;
    }
}
$Word_KeyArr= array_keys($wordSensation);
$file = fopen('files/bubbleGraphCompare.csv', 'w');
$row =["id","value"];
fputcsv($file, $row);
foreach($Word_KeyArr as $word ) {
    $row = [myUrlEncode ($word), $wordSensation[$word]];
    fputcsv($file, $row);
}
fclose($file);



//////////////////

/* Bar Graph Comparision */
$file = fopen('files/barGraphCompare.csv', 'w');

$row=['State',$user,"Average"];
fputcsv($file, $row);

$row=['Posting Question',pg_num_rows($post_Question),(pg_num_rows($post_Question))/$total_User];
fputcsv($file, $row);

$row=['post Answer',pg_num_rows($post_Answer),(pg_num_rows($post_Answer_Compare))/$total_User];
fputcsv($file, $row);

$row=['Question',pg_num_rows($question),(pg_num_rows($question))/$total_User];
fputcsv($file, $row);

$row=['Post Tag',pg_num_rows($post_tag),(pg_num_rows($post_tag))/$total_User];
fputcsv($file, $row);

$row=['Search',pg_num_rows($search),(pg_num_rows($search_Compare))/$total_User];
fputcsv($file, $row);



fclose($file);




?>

<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="http://d3js.org/d3.v3.min.js"></script>

    <link href="profile.css" rel="stylesheet" type="text/css">
    <SCRIPT>
        function history(d) {
            $.ajax({
                type: "POST",
                action: 'xhttp',
                url: "lineGraph.php",
                data: {user:'<?php echo $user; ?>',desc:d},
                success: function(response){

                    $('#Daystrends').replaceWith(response);
                },
                error: function(e){
                    // alert(e.message);
                }
            });
        }


        function TwoParameterCompare(){
            value1=document.getElementById("Value1");
            value1=value1.options[value1.selectedIndex].value;
            value2=document.getElementById("Value2");
            value2=value2.options[value2.selectedIndex].value;
            $.ajax({
                type: "POST",
                action: 'xhttp',
                url: "TwoParamterCompare.php",
                data: {user:'<?php echo $user; ?>',value1:value1,value2:value2},
                success: function(response){
                  // alert(response);
                    $('#TwoParameter').replaceWith(response);
                },
                error: function(e){
                    // alert(e.message);
                }
            });
        }
    </SCRIPT>
    <style> /* set the CSS */

        .bar { fill: steelblue; }
        table{
            width:100%;
            height:100%;
            border: 0;
        }
        iframe{
            border: 0;
        }
    </style>
</head>
<body background-color="white" >

<!--
<iframe name="barGraph" id="barGraph"  width="100%" height="50%" src="barGraph.php"></iframe>
-->


<h1 align="center" style="color: #f24537"><?php echo $user; ?></h1>



<div align="center"><a style="font-size: 16px;" href="index.php">logout</a></div>
<br/><br/>
<div align="center"><a style="font-size: 18px;"  target="_blank" href="https://stackoverflow.com/questions/tagged/java?sort=frequent&pageSize=15") >Goto: Stackoverflow </a></div>
<br/>
<br/>

<h5> Tracked Acitivities  </h5>

<ol align="left" >
    <li> <b>Posting Question:</b> This helpls us tracking the questions posted. </li>
    <li> <b>Posting Answer:</b> This helpls us tracking the answer posted by user.</li>
    <li> <b>Post Tag Visited:</b> This helpls us tracking post(Tag) visited by user.</li>
    <li> <b>Question Visited:</b> This helpls us tracking the question visited by user. </li>
    <li> <b>Search:</b> This helpls us tracking the questions/ post anything searched by user.</li>
</ol>

<h5> Pattern Finding </h5>
<ol align="left" >
    <li> <b>Chart 1:</b>This help us comparing any two of the above  mentioned five activities. If the user has more count of posting questions as compares to posting answers than that means user primarly visits the site for seeking help else if the count of answer is high than that means he visitis site to answer the questions. This  means that he has good knowledge of the subject area where he answers the questiosn. similarly, we can draw many more conclusions based on the relative comparision between the activities. </li>
    <br/>
    <li> <b>Chart 2:</b>This help us finding the count of activities by that particular user vs average count of all the activities made by all the users. This helps us finding how much user is active as compared to other users on the sarckoverflow. We can also find the pattern of activities for which is a particular  user  is more active than the average users on the site.  </li>
    <br/>
    <li> <b>chart 3:</b>User can click any of the button to find the pattern of that particular activity for past 30 days. This help us fiding the pattern of user behaviour for that particular activities for past 30 days. </li>
    <br/>
    <li> <b>Chart 4:</b>Word Cloud can help us tracking Post Tag visited by that user. Bigger is the cloud more the no.of times user visited that Cloud. This helps us tracking the tags visited by a user. You can click on any of the cloud which will show another bar  graph which displays the count of all the activities which involves that particular tagged post. This helps us finding the activity patterns involved that word. For example for Java, the count of asking question is more than the count of posting answers than user is week in that area but on the other hand if Posting answers on SQL topic is more than user is expert in that area. This give us topic wise analysis.   </li>
    <br/>
    <li> <b>Chart 5:</b>Word Cloud can help us tracking Post Tag visited by all the users. Bigger is the cloud more the no.of times users visited that Cloud.You can click on any of the cloud which will show another bar  graph which displays the count of all the activities which involves that particular word. This help us doing compartive study of user behaviour as compared to all the users on site. This also helps us in finding the pattern or the topic where users are asking more question than posting answers or vice versa. we can a lot of relative studies.    </li>
    <br/>
    <li> <b>Chart 6:</b> This graph which displays the count of all the activities which involves that particular tagged post. This helps us finding the activity patterns involved that word. For example for Java, the count of asking question is more than the count of posting answers than user is week in that area but on the other hand if Posting answers on SQL topic is more than user is expert in that area. This give us topic wise analysis.   </li>
    <br/>
    <li> <b>Chart 7:</b>Based on the word cloud clicked above. This helps us tracking the activities based on that tag word. Bar  graph which displays the count of all the activities which involves that particular word. This help us doing compartive study of user behaviour as compared to all the users on site. This also helps us in finding the pattern or the topic where users are asking more question than posting answers or vice versa. we can a lot of relative studies. which is the most searched topic or etc.    </li>

</ol>

<br/><br/>
<div align="center"><h2> Social Visualization</h2></div>
<br/>

<div align="center" >
    <h3>Chart: 1</h3>
    <h4>This Graph comapares any two activities from the above mentioned five activities.</h4>
    <select id="Value1" >
        <option selected="selected" value="Post Question">Post Question</option>
        <option value="Post Answer">Post Answer</option>
        <option value="search">Search</option>
        <option value="question-hyperlink">Questions Searched</option>
        <option value="post-tag">Post Tag</option>
    </select>

    <select id="Value2" >
        <option selected="selected" value="Post Question">Post Question</option>
        <option value="Post Answer">Post Answer</option>
        <option value="search">Search</option>
        <option value="question-hyperlink">Questions Searched</option>
        <option value="post-tag">Post Tag</option>
    </select>
    <button onclick="TwoParameterCompare()" >Show </button>
    <br/><br/>
    <div align="center" id="TwoParameter"></div>
</div>


<br/><br/><br/>

<div align="center" >
    <h3>Chart: 2</h3>
    <h4>This Graph comapres the Logined User activities with the avearge User actvities on Stackoverflow.</h4>
    <iframe align="center" width="60%" height="60%"  src="barGraphCompare.php"></iframe>
</div>

<div align="center" id="#line">
    <h3>Chart: 3</h3>
    <h4>This Graph gives user information abput specific activities of past 30 days.</h4>
    <h5>Click on the button</h5>
    <br/>
    <a class="btnLink" onclick="history('Post Question')">Post Question</a>
    <a class="btnLink" onclick="history('Post Answer')">Post Answer</a>
    <a class="btnLink" onclick="history('search')">Search</a>
    <a class="btnLink" onclick="history('question-hyperlink')">Question Searched</a>
    <a class="btnLink" onclick="history('post-tag')">Visited Post Tag</a>

    <br/><br/><br/><br/>
    <div id="Daystrends"></div>
</div>

<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
<div align="center" >
    <table>
        <tr>
            <td align="center" width="50%" >
                <h3>Chart: 4</h3>
                <h4 >This Bubbles gives the information about the POST TAG visited by Logined User.</h4>
                <h5>Click on the bubble to see the count of interaction which are based on the tag word clicked.</h5>
                <iframe width="100%" height="130%"  src="bubbleGraph.php?user=<?php echo $user;?>"></iframe>
            </td>
            <td align="center" >
                <h3>Chart: 5</h3>
                <h4>This Bubbles gives the information about the POST TAG visited by all the Users.</h4>
                <h5>Click on the bubble to see the count of interaction which are based on the tag word clicked.</h5>
                <iframe width="100%" height="130%" src="bubbleGraphCompare.php"></iframe>
            </td>
        </tr>
    </table>
</div>

<br/><br/><br/>
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
                <tr> <td> <?php echo $i++;?></td><td><?php echo date("Y-m-d H:i:s.u", strtotime($row[1])); ?></td> </tr>
            <?php }  ?>
            </tbody>

        </table>
    </div>
</div>
<!--
<div align="center"  >
    <h1> Activites Details </h1>


    <table border="1" width="30%" align="center">
        <thead style="font-size: 12px;font-weight: bold" >
        <tr>
            <td>
                Sno.
            </td>
            <td>
                Type
            </td>
            <td>
                Head
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
            <tr> <td> <?php echo $i++;?></td><td><?php echo $row[1]; ?></td><td><?php echo $row[3]; ?></td><td><?php echo $row[2]; ?></td><td><?php echo date("y-m-d", strtotime($row[4])); ?></td> </tr>
        <?php }  ?>0
        </tbody>

    </table>




</div>
-->
</body>
</html>
