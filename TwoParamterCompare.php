<?php
/**
 * Created by PhpStorm.
 * User: goyal
 * Date: 9/24/2017
 * Time: 9:42 PM
 */


date_default_timezone_set('MST');
$appName = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$connStr = "host=ec2-23-21-197-175.compute-1.amazonaws.com port=5432 dbname=d2bu35u7977nam user=zhnknooxixzmqn password=6772ed3336642783bb0c73e57993b98f4f4994386fed3ae08666a0ed9c91ec2a";
$conn = pg_connect($connStr);

$value1= $_POST["value1"];
$value2 = $_POST['value2'];
$user = $_POST['user'];

$file = fopen('files/TwoParameter.csv', 'w');
$row=['age','population'];
fputcsv($file, $row);


$sql="SELECT count(*) from \"activity\" where \"user\" = '$user' and \"head\" = '$value1'";
$result = pg_query($conn,$sql);

while ($row =  pg_fetch_row($result)) {
    //$res=[$value1,$row[0]];
    $res[0]=$row[0];
    fputcsv($file, $res);

}

 $sql="SELECT count(*) from \"activity\" where \"user\" = '$user' and \"head\" = '$value2'";
$result = pg_query($conn,$sql);

while ($row =  pg_fetch_row($result)) {
    //$res=[$value2,$row[0]];
    $res[1]=$row[0];
    fputcsv($file, $res);

}


fclose($file);

$wordSensation['post-tag']="Post Tag";
$wordSensation['question-hyperlink']="Question Searched";
$wordSensation['search']="Search";
$wordSensation['Post Question']="Post Questions";
$wordSensation['Post Answer']="Post Answers";


?>
<html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <title>Testing Pie Chart</title>
    <script type="text/javascript" src="https://mbostock.github.com/d3/d3.js?2.1.3"></script>
    <script type="text/javascript" src="https://mbostock.github.com/d3/d3.geom.js?2.1.3"></script>
    <script type="text/javascript" src="https://mbostock.github.com/d3/d3.layout.js?2.1.3"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="http://d3js.org/d3.v3.min.js"></script>

    <style type="text/css">
        .slice text {
            font-size: 9pt;
            font-family: Arial;
        }
    </style>
</head>
<body>
<div align="center" id="TwoParameter"></div>
<script type="text/javascript">

    var w = 300,                        //width
        h = 300,                            //height
        r = 100,                            //radius
        color = d3.scale.category20c();     //builtin range of colors

    val1='<?php echo $wordSensation[$value1]; ?>';
    val2='<?php echo $wordSensation[$value2]; ?>';
    value1='<?php echo $res[0]; ?>';
    value2='<?php echo $res[1]; ?>';
    data = [{"label":val1, "value":value1},
        {"label":val2, "value":value2}];

    var vis = d3.select("#TwoParameter")
        .append("svg:svg")              //create the SVG element inside the <body>
        .data([data])                   //associate our data with the document
        .attr("width", w)           //set the width and height of our visualization (these will be attributes of the <svg> tag
        .attr("height", h)
        .append("svg:g")                //make a group to hold our pie chart
        .attr("transform", "translate(" + r + "," + r + ")")    //move the center of the pie chart from 0, 0 to radius, radius

    var arc = d3.svg.arc()              //this will create <path> elements for us using arc data
        .outerRadius(r);

    var pie = d3.layout.pie()           //this will create arc data for us given a list of values
        .value(function(d) { return d.value; });    //we must tell it out to access the value of each element in our data array

    var arcs = vis.selectAll("g.slice")     //this selects all <g> elements with class slice (there aren't any yet)
        .data(pie)                          //associate the generated pie data (an array of arcs, each having startAngle, endAngle and value properties)
        .enter()                            //this will create <g> elements for every "extra" data element that should be associated with a selection. The result is creating a <g> for every object in the data array
        .append("svg:g")                //create a group to hold each slice (we will have a <path> and a <text> element associated with each slice)
        .attr("class", "slice");    //allow us to style things in the slices (like text)

    arcs.append("path")
        .attr("fill", function(d, i) { return color(i+3); } ) //set the color for each slice to be chosen from the color function defined above
        .attr("d", arc);                                    //this creates the actual SVG path using the associated data (pie) with the arc drawing function

    arcs.append("svg:text")                                     //add a label to each slice
        .attr("transform", function(d) {                    //set the label's origin to the center of the arc
            //we have to make sure to set these before calling arc.centroid
            d.innerRadius = 0;
            d.outerRadius = r;
            return "translate(" + arc.centroid(d) + ")";        //this gives us a pair of coordinates like [50, 50]
        })
        .attr("text-anchor", "middle")                          //center the text on it's origin
        .text(function(d, i) { return data[i].label; });        //get the label from our original data array

</script>
</body>
</html>