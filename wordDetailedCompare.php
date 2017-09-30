<?php
/**
 * Created by PhpStorm.
 * User: goyal
 * Date: 9/24/2017
 * Time: 9:42 PM
 */

$appName = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$connStr = "host=ec2-23-21-197-175.compute-1.amazonaws.com port=5432 dbname=d2bu35u7977nam user=zhnknooxixzmqn password=6772ed3336642783bb0c73e57993b98f4f4994386fed3ae08666a0ed9c91ec2a";
$conn = pg_connect($connStr);
 $desc = $_POST["desc"];
$sql="SELECT count(*) from \"login\"";
$result = pg_fetch_row(pg_query($conn,$sql));
$total_User=$result[0];


$sql="SELECT count(*),head from \"activity\" where  \"desc\" LIKE '%$desc%' group by \"head\" ";
$result = pg_query($conn,$sql);
while ($row =  pg_fetch_row($result)) {
    $resultWord[$row[1]]=$row[0]/$total_User;
}

$file = fopen('files/wordDetailedCompare.csv', 'w');
$row=['salesperson','sales'];
fputcsv($file, $row);



$wordSensation=['post-tag','question-hyperlink','search','Post Question','Post Answer'];
//$resultWord;

foreach($wordSensation as $index){
    if(!isset($resultWord[$index])){
        $resultWord[$index]=0;
    }

    $temp = [$index,$resultWord[$index]];
    fputcsv($file, $temp);
    // $temp["area"]=$index;
    // $temp["value"]=$resultWord[$index];

    // $post[]=array($temp);


}


fclose($file);

//var_dump($resultWord);
?>
<style> /* set the CSS */

    .bar { fill: steelblue; }

</style>
<div id="wordDetailedCompare">

    <!-- load the d3.js library -->
    <script src="//d3js.org/d3.v4.min.js"></script>
    <script>

        // set the dimensions and margins of the graph
        var margin = {top: 20, right: 20, bottom: 30, left: 40},
            width = 460 - margin.left - margin.right,
            height = 200 - margin.top - margin.bottom;

        // set the ranges
        var x = d3.scaleBand()
            .range([0, width])
            .padding(0.1);
        var y = d3.scaleLinear()
            .range([height, 0]);

        // append the svg object to the body of the page
        // append a 'group' element to 'svg'
        // moves the 'group' element to the top left margin
        var svg = d3.select("#wordDetailedCompare").append("svg")
            .attr("width", width + margin.left + margin.right)
            .attr("height", height + margin.top + margin.bottom)
            .append("g")
            .attr("transform",
                "translate(" + margin.left + "," + margin.top + ")");

        // get the data
        d3.csv("files/wordDetailedCompare.csv", function(error, data) {
            if (error) throw error;

            // format the data
            data.forEach(function(d) {
                d.sales = +d.sales;
            });

            // Scale the range of the data in the domains
            x.domain(data.map(function(d) { return d.salesperson; }));
            y.domain([0, d3.max(data, function(d) { return d.sales; })]);

            // append the rectangles for the bar chart
            svg.selectAll(".bar")
                .data(data)
                .enter().append("rect")
                .attr("class", "bar")
                .attr("x", function(d) { return x(d.salesperson); })
                .attr("width", x.bandwidth())
                .attr("y", function(d) { return y(d.sales); })
                .attr("height", function(d) { return height - y(d.sales); });

            // add the x Axis
            svg.append("g")
                .attr("transform", "translate(0," + height + ")")
                .call(d3.axisBottom(x));

            // add the y Axis
            svg.append("g")
                .call(d3.axisLeft(y));

        });

    </script>
</div>