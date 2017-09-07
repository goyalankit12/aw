$("a").click(function(e) {

    var desc= $(event.target).attr('class')+":      "+e.target.toString();
    alert(desc);
    $.ajax({
        type: "POST",
        action: 'xhttp',
        url: "https://aw-assignment1.herokuapp.com/ind.php",
        data: {type:"Achor Element",desc:desc},
        success: function(response){
            alert(response+'Items added');
        },
        error: function(e){
            console.log(e.message);
            alert(e.message+'  Addition Failed');
        }
    });
});


$("input").click(function(e) {

    var desc= $(event.target).attr('class')+":      "+e.target.toString();
    alert(desc);

    $.ajax({
        type: "POST",
        action: 'xhttp',
        url: "https://aw-assignment1.herokuapp.com/ind.php",
        data: {type:"Button",desc:desc},
        success: function(response){
            alert(response+'Items added');
        },
        error: function(e){
            console.log(e.message);
            alert(e.message+'  Addition Failed');
        }
    });

   // alert("aaa"+e.target.toString()); // gives the element's ID
    // gives the elements class(es)
});
