

$( window ).scroll(function(event) {
    $.ajax({
        type: "POST",
        action: 'xhttp',
        url: "https://aw-assignment1.herokuapp.com/ind.php",
        data: {type:"Scroll",desc:"window is scrolled."},
        success: function(response){
            alert(response+'Items addeddddddddddddddddddd');
        },
        error: function(e){
            console.log(e.message);
            alert(e.message+'  Addition Failed');
        }
    });
});



$("a").click(function(e) {

    var desc="";

    if(typeof $(event.target).attr('class') !== 'undefined' && $(event.target).attr('class') !== 'undefined')desc = $(event.target).attr('class');
    if(typeof e.target.toString() !== 'undefined' && e.target.toString() !== 'undefined')desc = desc+" "+e.target.toString();

    alert(desc);
    $.ajax({
        type: "POST",
        action: 'xhttp',
        url: "https://aw-assignment1.herokuapp.com/ind.php",
        data: {type:"Achor Element",desc:desc},
        success: function(response){
            alert(response+'Items addeddddddddddddddddddd');
        },
        error: function(e){
            console.log(e.message);
            alert(e.message+'  Addition Failed');
        }
    });
});


$("input").click(function(e) {

    var desc="";
    if(typeof $(event.target).attr('class') !== 'undefined' && $(event.target).attr('class') !== 'undefined')desc = $(event.target).attr('class');
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

});
