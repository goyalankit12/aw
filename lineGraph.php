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

 $desc = $_POST["desc"];
 $user = $_POST['user'];

$sql="SELECT * from \"activity\" where \"user\" = '$user' and \"head\" = '$desc'";
$result = pg_query($conn,$sql);
//date("Ymd", strtotime("05:32:24.270569+00"));
$cur_Date = date("Ymd");
$resultWord=[];
while ($row =  pg_fetch_row($result)) {
    //var_dump($row);

 $db_Date = date("Ymd", strtotime($row[4]));


    if($cur_Date-30<=$db_Date && $cur_Date>=$db_Date ){
        if(isset($resultWord[$db_Date])){
            $resultWord[$db_Date]=$resultWord[$db_Date]+1;
        }
        else{
            $resultWord[$db_Date]=1;
        }
    }

}

$file = fopen('files/lineGraph.csv', 'w');
$row=['date','close'];
fputcsv($file, $row);
$Word_KeyArr= array_keys($resultWord);
sort($Word_KeyArr);
foreach($Word_KeyArr as $word ) {
    $row = [date('d-M-y', strtotime($word)), $resultWord[$word]];
    fputcsv($file, $row);
}
fclose($file);


//var_dump($resultWord);

?>

<!DOCTYPE html>
<meta charset="utf-8">
<style> /* set the CSS */

    body { font: 12px Arial;}

    .pathfill {
        stroke: steelblue;
        stroke-width: 2;
        fill: none;
    }

    .axis path,
    .axis line {
        fill: none;
        stroke: grey;
        stroke-width: 1;
        shape-rendering: crispEdges;
    }

</style>
<body>
<div id="Daystrends" ></div>
<!-- load the d3.js library -->
<script src="https://d3js.org/d3.v3.min.js"></script>

<script>

    // Set the dimensions of the canvas / graph
    var margin = {top: 30, right: 20, bottom: 30, left: 50},
        width = 600 - margin.left - margin.right,
        height = 270 - margin.top - margin.bottom;

    // Parse the date / time
    var parseDate = d3.time.format("%d-%b-%y").parse;

    // Set the ranges
    var x = d3.time.scale().range([0, width]);
    var y = d3.scale.linear().range([height, 0]);

    // Define the axes
    var xAxis = d3.svg.axis().scale(x)
        .orient("bottom").ticks(5);

    var yAxis = d3.svg.axis().scale(y)
        .orient("left").ticks(5);

    // Define the line
    var valueline = d3.svg.line()
        .x(function(d) { return x(d.date); })
        .y(function(d) { return y(d.close); });

    // Adds the svg canvas
    var svgLine = d3.select("#Daystrends")
        .append("svg")
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
        .append("g")
        .attr("transform",
            "translate(" + margin.left + "," + margin.top + ")");

    // Get the data
    d3.csv("files/lineGraph.csv", function(error, data) {
        data.forEach(function(d) {
            d.date = parseDate(d.date);
            d.close = +d.close;
        });

        // Scale the range of the data
        x.domain(d3.extent(data, function(d) { return d.date; }));
        y.domain([0, d3.max(data, function(d) { return d.close; })]);

        // Add the valueline path.
        svgLine.append("path")
            .attr("class", "line")
            .attr("d", valueline(data))
            .attr("class", "pathfill");;

        // Add the X Axis
        svgLine.append("g")
            .attr("class", "x axis")
            .attr("transform", "translate(0," + height + ")")
            .call(xAxis);

        // Add the Y Axis
        svgLine.append("g")
            .attr("class", "y axis")
            .call(yAxis);

    });

</script>
</body>
