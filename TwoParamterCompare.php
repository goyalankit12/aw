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
    $res[0]=$row[0];
    fputcsv($file, $res);

}

$sql="SELECT count(*) from \"activity\" where \"user\" = '$user' and \"head\" = '$value2'";
$result = pg_query($conn,$sql);

while ($row =  pg_fetch_row($result)) {
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://d3js.org/d3.v3.min.js"></script>

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
        .append("svg:svg")
        .data([data])
        .attr("width", w)
        .attr("height", h)
        .append("svg:g")
        .attr("transform", "translate(" + r + "," + r + ")")

    var arc = d3.svg.arc()
        .outerRadius(r);

    var pie = d3.layout.pie()
        .value(function(d) { return d.value; });

    var arcs = vis.selectAll("g.slice")
        .data(pie)
        .enter()
        .append("svg:g")
        .attr("class", "slice");

    arcs.append("path")
        .attr("fill", function(d, i) { return color(i+3); } )
        .attr("d", arc);
    arcs.append("svg:text")
        .attr("transform", function(d) {

            d.innerRadius = 0;
            d.outerRadius = r;
            return "translate(" + arc.centroid(d) + ")";

        })
        .attr("text-anchor", "middle")
        .text(function(d, i) { return data[i].label; });

</script>
</body>
</html>